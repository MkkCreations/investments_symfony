<?php

namespace App\Controller;

use App\Entity\Balance;
use App\Entity\LogBalance;
use App\Form\BalanceFormType;
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
        $balance = new Balance();
        $form = $this->createForm(BalanceFormType::class, $balance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $balance->setUser($this->getUser());
            $balance->setCurrency($this->getUser()->getBalance()->getCurrency());
            $entityManager->persist($balance);
            $entityManager->flush();
        }

        $balanceLogs = $this->getUser()->getBalance()->getLogBalances()->toArray();
        return $this->render('balance/index.html.twig', [
            'balanceLogs' => $balanceLogs,
            'form' => $form->createView(),
        ]);
    }
/* 
    #[Route('/balance/add', name: 'app_balance_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $amount = $request->request->get('amount');
        $balance = $this->getUser()->getBalance();
        $balance->setAmount($balance->getAmount() + $amount);

        $balanceLog = new LogBalance($balance, $amount, "add");

        $entityManager->persist($balanceLog);
        $entityManager->persist($balance);

        $entityManager->flush();
        return $this->redirectToRoute('app_balance');
    } */
}
