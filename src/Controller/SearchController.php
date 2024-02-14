<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Repository\MissionRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request,ContactRepository $contactRepository,ProduitRepository $produitRepository,MissionRepository $missionRepository): Response
    {
       
       $req = strtolower( $request->get('q') );

       $contacts = $contactRepository->findAll();

       $produits = $produitRepository->findAll();

       $missions = $missionRepository->findAll();

       $TabrequestContact = [] ; 
       $TabrequestProduit = [] ; 
       $TabrequestMission = [] ; 
       $TabrequestEnt = [] ;


       foreach ($contacts as $c){

            $nom = $c->getNom().$c->getPrenom().$c->getEntreprise() ; 
            // Teste si la chaîne contient le mot
            if(strpos( strtolower( $nom ) , $req ) !== false){   
                $TabrequestContact[] = $c;
                
                } else{
                
                }
        }

        foreach ($produits as $p) {
            
            $produit = $p->getName();

            if(strpos( strtolower( $produit ) , $req ) !== false){   
                $TabrequestProduit[] = $p;
            } else{
            
            }

        }
        
        foreach ($missions as $m) {
            
            $mission = $m->getName();

            if(strpos( strtolower( $mission ) , $req ) !== false){   
                $TabrequestMission[] = $m;
            } else{
            
            }
        }


       

       /*
        $mot = "WayToLearnX";
        $str = "Hello, Welcom to WayToLearnX";
        
        // Teste si la chaîne contient le mot
        if(strpos($str, $req) !== false){
            echo "Le mot existe!";
        } else{
            echo "Le mot n'existe pas!";
        }
        */



        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
            'resultContact' => $TabrequestContact,
            'resultProduit' => $TabrequestProduit,
            'resultMission' => $TabrequestMission,
            'result' => $TabrequestEnt ,

        ]);
    }
}
