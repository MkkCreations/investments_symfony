<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Entity\LogBalance;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private array $data = [
        [
            "name" => "Kunze - Kuhn",
            "price" => "1.2",
            "id" => "0"
        ],
        [
            "name" => "Ullrich, Howe and Erdman",
            "price" => "5.4",
            "id" => "1"
        ],
        [
            "name" => "Tillman, Moore and Romaguera",
            "price" => "134.9",
            "id" => "2"
        ],
        [
            "name" => "Tremblay - Dickinson",
            "price" => "7.2",
            "id" => "3"
        ],
        [
            "name" => "Shields, Bradtke and Nitzsche",
            "price" => "45.7",
            "id" => "4"
        ],
        [
            "name" => "Kuhic, Collier and Schimmel",
            "price" => "4.3",
            "id" => "5"
        ],
        [
            "name" => "Bednar and Sons",
            "price" => "213.4",
            "id" => "6"
        ],
        [
            "name" => "Dach - Mann",
            "price" => "68.9",
            "id" => "7"
        ],
        [
            "name" => "Moen, Leannon and Gutmann",
            "price" => "52.4",
            "id" => "8"
        ],
        [
            "name" => "Bode - Jones",
            "price" => "89.1",
            "id" => "9"
        ],
        [
            "name" => "Reinger - Cummings",
            "price" => "33.6",
            "id" => "10"
        ],
        [
            "name" => "Gutkowski - McGlynn",
            "price" => "3.2",
            "id" => "11"
        ],
        [
            "name" => "Hagenes - Mills",
            "price" => "78.3",
            "id" => "12"
        ],
        [
            "name" => "Goyette - Larson",
            "price" => "90.1",
            "id" => "13"
        ],
        [
            "name" => "Kozey, Lemke and Herzog",
            "price" => "1.92",
            "id" => "14"
        ],
        [
            "name" => "Runte - Harvey",
            "price" => "0.45",
            "id" => "15"
        ],
        [
            "name" => "Lubowitz LLC",
            "price" => "21.7",
            "id" => "16"
        ],
        [
            "name" => "Miller - Wisozk",
            "price" => "98.3",
            "id" => "17"
        ],
        [
            "name" => "Feest Group",
            "price" => "120.9",
            "id" => "18"
        ],
        [
            "name" => "Beatty, Fahey and Green",
            "price" => "9.75",
            "id" => "19"
        ],
        [
            "name" => "Emard Group",
            "price" => "4.32",
            "id" => "20"
        ],
        [
            "name" => "Frami - Hackett",
            "price" => "2.89",
            "id" => "21"
        ],
        [
            "name" => "Jaskolski, Reynolds and Robel",
            "price" => "7.45",
            "id" => "22"
        ],
        [
            "name" => "Pouros and Sons",
            "price" => "55.7",
            "id" => "23"
        ],
        [
            "name" => "Swift Group",
            "price" => "82.9",
            "id" => "24"
        ],
        [
            "name" => "Roob, Dickens and Bahringer",
            "price" => "202.6",
            "id" => "25"
        ],
        [
            "name" => "Emmerich - Marvin",
            "price" => "431.2",
            "id" => "26"
        ],
        [
            "name" => "Conn - Glover",
            "price" => "88.9",
            "id" => "27"
        ],
        [
            "name" => "Leuschke, Lebsack and Connelly",
            "price" => "3.77",
            "id" => "28"
        ],
        [
            "name" => "Williamson Inc",
            "price" => "0.18",
            "id" => "29"
        ],
        [
            "name" => "Rempel - Huels",
            "price" => "1.68",
            "id" => "30"
        ]
    ];

    #[Route('/home', name: 'app_home')]
    public function index(Request $request): Response
    {
        return $this->render('home/index.html.twig', [
            'data' => $this->getStockData(),
        ]);
    }

    public function getStockData(): array
    {
        foreach ($this->data as $key => $value) {
            $this->data[$key]['price'] = (float)$this->data[$key]['price'] * (rand(20, 80) / 80 + 0.5);
        }

        return $this->data;
    }

    #[Route('/home/{id}', name: 'app_home_id')]
    public function buyStock(Request $request, EntityManagerInterface $entityManager): Response
    {
        $error = null;
        $stock = array_values(array_filter($this->data, fn ($stock) => $stock['id'] == $request->attributes->get('id')))[0];
        if ($request->isMethod('POST')) {
            if ($this->getUser()->getBalance()->getAmount() >= $stock['price'] * $request->request->get('amount')) {
                $asset = new Asset();
                $asset->setName($stock['name']);
                $asset->setBoughtPrice($stock['price']);
                $asset->setBoughtAt(new \DateTimeImmutable());
                $asset->setAmount($request->request->get('amount'));
                $asset->setPortfolio(array_values(array_filter($this->getUser()->getPortfolios()->toArray(), fn ($portfolio) => $portfolio->getId() == $request->request->get('portfolio')))[0]);

                $balance = $this->getUser()->getBalance();
                $amount = $stock['price'] * $request->request->get('amount');
                $balance->setAmount($balance->getAmount() - $amount);
        
                $balanceLog = new LogBalance($balance, $amount, "remove");
        
                $entityManager->persist($balanceLog);
                $entityManager->persist($balance);
                $entityManager->persist($asset);
                $entityManager->flush();
                $this->redirectToRoute('app_home');
            } else {
                $error = "You don't have enough money";
            }
        }

        return $this->render('home/buy.html.twig', [
            'stock' => $stock,
            'portfolios' => $this->getUser()->getPortfolios()->toArray(),
            'error' => $error,
        ]);
    }
}
