<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TacheEncoursController extends AbstractController
{
    #[Route('/tache/encours', name: 'app_tache_encours')]
    public function index(): Response
    {
        return $this->render('tache_encours/index.html.twig', [
            'controller_name' => 'TacheEncoursController',
        ]);
    }
}
