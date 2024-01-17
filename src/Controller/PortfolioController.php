<?php

namespace App\Controller;

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


        $total = 0;
        $actual = 0;

        $total = array_sum(array_map(fn ($asset) => $total += $asset->getAmount() * $asset->getBoughtPrice(), $portfolio->getAssets()->toArray()));

        $actual = array_sum(array_map(fn ($asset) => $actual += $asset->getAmount() * array_values(array_filter($newData, fn ($stock) => $stock['name'] == $asset->getName()))[0]['price'], $portfolio->getAssets()->toArray()));


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
        $em->remove($portfolio);
        $em->flush();
        return $this->redirectToRoute('app_portfolio');
    }
}
