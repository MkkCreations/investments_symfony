<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\LogBalance;
use App\Entity\Portfolio;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'app_portfolio')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $portfolioName = $request->request->get('name');
            $portfolio = new Portfolio();
            $portfolio->setName($portfolioName);
            $portfolio->setUser($this->getUser());
            $this->getUser()->addPortfolio($portfolio);
            $entityManager->persist($portfolio);
            $entityManager->flush();
            return $this->redirectToRoute('app_portfolio');
        }
        return $this->render('portfolio/index.html.twig', [
            'controller_name' => 'PortfolioController',
        ]);
    }

    #[Route('/portfolio/{id}', name: 'app_portfolio_show')]
    public function show(Request $req, EntityManagerInterface $em): Response
    {
        $id = $req->get('id');
        $portfolio = $em->getRepository(Portfolio::class)->find($id);

        $homeController = new HomeController();
        $newData = $homeController->getStockData();


        $total = $this->getTotalValue($portfolio);
        $actual = $this->getActualValue($portfolio, $newData);


        return $this->render('portfolio/portfolio.html.twig', [
            'portfolio' => $portfolio,
            'total' => $total,
            'actual' => $actual,
            'newData' => $newData,
        ]);
    }

    #[Route('/porfolio/delete/{id}', name: 'app_portfolio_delete')]
    public function delete(Request $req, EntityManagerInterface $em): Response
    {
        $id = $req->get('id');
        $portfolio = $em->getRepository(Portfolio::class)->find($id);
        $balance = $this->getUser()->getBalance();
        foreach ($portfolio->getAssets() as $asset) {
            $newAsset = $this->sellAsset($portfolio, $asset, $em);
            $balance->setAmount($balance->getAmount() + $asset->getAmount() * $newAsset->getSoldPrice());
            $balanceLog = new LogBalance($balance, $asset->getAmount() * $newAsset->getSoldPrice(), "add");
            $em->persist($balanceLog);
        }
        $em->persist($balance);
        $em->remove($portfolio);
        $em->flush();
        return $this->redirectToRoute('app_portfolio');
    }

    public function getTotalValue($portfolio): float
    {
        $total = 0;
        foreach ($portfolio->getAssets() as $asset) {
            $total += $asset->getAmount() * $asset->getBoughtPrice();
        }
        return $total;
    }

    public function getActualValue(Portfolio $portfolio, array $newData): float
    {
        $actual = 0;
        foreach ($portfolio->getAssets() as $asset) {
            foreach ($newData as $stock) {
                if ($stock['name'] == $asset->getName()) {
                    if ($asset->isActive()) $actual += $asset->getAmount() * $stock['price'];
                    else $actual += $asset->getAmount() * $asset->getSoldPrice();
                }
            }
        }
        return $actual;
    }

    public function findAssetNewData($asset, $newData): ?array
    {
        foreach ($newData as $stock) {
            if ($stock['name'] == $asset->getName()) {
                return $stock;
            }
        }
        return null;
    }

    public function sellAsset($portfolio, $asset, $em): Asset
    {
        $homeController = new HomeController();
        $newData = $homeController->getStockData();
        $asset->setSoldPrice($this->findAssetNewData($asset, $newData)['price']);
        $asset->setActive(false);
        $em->persist($asset);
        $em->flush();
        return $asset;
    }
}
