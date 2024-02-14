<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TacheOkController extends AbstractController
{
    #[Route('/tache/ok', name: 'app_tache_ok')]
    public function index(): Response
    {
        return $this->render('tache_ok/index.html.twig', [
            'controller_name' => 'TacheOkController',
        ]);
    }
}
