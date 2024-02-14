<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteDefraisController extends AbstractController
{
    #[Route('/note/defrais', name: 'app_note_defrais')]
    public function index(): Response
    {
        return $this->render('note_defrais/index.html.twig', [
            'controller_name' => 'NoteDefraisController',
        ]);
    }

    
}
