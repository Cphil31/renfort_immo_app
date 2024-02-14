<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LettredemissionController extends AbstractController
{
    #[Route('/lettredemission', name: 'app_lettredemission')]
    public function index(): Response
    {
        return $this->render('lettredemission/index.html.twig', [
            'controller_name' => 'LettredemissionController',
        ]);
    }
}
