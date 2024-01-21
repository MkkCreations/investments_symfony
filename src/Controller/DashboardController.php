<?php

namespace App\Controller;

use App\Entity\Role;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(UserRepository $userRepo): Response
    {
        $this->denyAccessUnlessGranted(Role::ROLE_USER->value);

        $homeController = new HomeController();
        $newData = $homeController->getStockData();

        $newData = $homeController->getStockData();

        return $this->render('dashboard/index.html.twig', [
            'newData' => $newData
        ]);
    }
}
