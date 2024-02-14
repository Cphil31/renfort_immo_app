<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestPdfController extends AbstractController
{
    #[Route('/test/pdf', name: 'app_test_pdf')]
    public function index(): Response
    {
        return $this->render('test_pdf/index.html.twig', [
            'controller_name' => 'TestPdfController',
        ]);
    }
}
