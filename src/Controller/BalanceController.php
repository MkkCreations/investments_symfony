<?php

namespace App\Controller;

use App\Entity\Balance;
use App\Entity\LogBalance;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BalanceController extends AbstractController
{
    #[Route('/balance', name: 'app_balance')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        if ($request->isMethod('POST')) {
            $amount = $request->request->get('amount');
            $balance =$this->getUser()->getBalance();
            $balance->setAmount($balance->getAmount() + $amount);

            $balanceLog = new LogBalance($balance, $amount);

            $entityManager->persist($balanceLog);
            $entityManager->persist($balance);

            $entityManager->flush();
            return $this->redirectToRoute('app_balance');
        }

        $balances = $this->getUser()->getBalance()->getLogBalances()->toArray();
        return $this->render('balance/index.html.twig', [
            'balances' => $balances,
        ]);
    }
}
