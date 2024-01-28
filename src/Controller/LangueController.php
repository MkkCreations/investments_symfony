<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Translation\LocaleSwitcher;

class LangueController extends AbstractController
{

    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator, private LocaleSwitcher $localeSwitcher)
    {
        $this->urlGenerator = $urlGenerator;
    }

    #[Route('/changeLocale', name: 'changeLocale')]
    public function changeLocale(RequestStack $requestStack, Request $request)
    {
        $langue = $request->request->get('langue');
        
        $requestStack->getSession()->set('_locale', $langue);
        return new Response("ok");
    }
}