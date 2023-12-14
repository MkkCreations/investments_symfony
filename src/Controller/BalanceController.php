<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BalanceController extends AbstractController
{
    #[Route('/balance', name: 'app_balance')]
    public function index(): Response
    {
        $balances = $this->getUser()->getBalance();
        return $this->render('balance/index.html.twig', [
            'balances' => $balances,
        ]);
    }
}
