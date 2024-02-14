<?php

namespace App\Controller;

use App\Repository\StatutTacheRepository;
use App\Repository\TacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TacheAFaireController extends AbstractController
{
    #[Route('/tache/a/faire', name: 'app_tache_a_faire')]
    public function index(StatutTacheRepository $statut, TacheRepository $tache): Response
    {
        $aFaire = $statut->findByName('A faire');
        
        $tachestab = $tache->findByStatut( $aFaire );

        return $this->render('tache_a_faire/index.html.twig', [
            'taches'=> $tachestab,
        ]);
    }
}
