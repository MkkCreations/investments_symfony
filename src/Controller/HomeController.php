<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ?array $data = [];
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        print_r($this->data);
        if (!empty($this->data)) {
            return $this->render('home/index.html.twig', [
                'data' => $this->data,
            ]);
        }
        $json = file_get_contents('https://www.alphavantage.co/query?function=TOP_GAINERS_LOSERS&apikey=9BE49Y47LUERO4E');

        $this->data = json_decode($json,true);

        return $this->render('home/index.html.twig', [
            'data' => $this->data,
        ]);
    }
}
