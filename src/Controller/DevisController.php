<?php

namespace App\Controller;

use App\Entity\Accompte;
use Dompdf\Dompdf;
use App\Entity\Devis;
use App\Form\DevisType;
use App\Form\DevisEditType;
use App\Entity\DevisReunion;
use App\Form\DevisReunionType;
use App\Entity\DevisPrestation;
use App\Entity\DevisDeplacement;
use App\Entity\DevisHebergement;
use App\Entity\OuvertureDossier;
use App\Entity\DevisRestauration;
use App\Entity\Forfait;
use App\Form\AccompteType;
use App\Form\DevisPrestationType;
use App\Form\DevisDeplacementType;
use App\Form\DevisHebergementType;
use App\Form\OuvertureDossierType;
use App\Form\DevisRestaurationType;
use App\Repository\AccompteRepository;
use App\Repository\DevisRepository;
use App\Repository\ContactRepository;
use App\Repository\DeplacementRepository;
use App\Repository\ProblemeRepository;
use App\Repository\DevisReunionRepository;
use App\Repository\DevisPrestationRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DevisDeplacementRepository;
use App\Repository\DevisHebergementRepository;
use App\Repository\OuvertureDossierRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\DevisRestaurationRepository;
use App\Repository\ForfaitRepository;
use App\Repository\HebergementRepository;
use App\Repository\IntervenantRepository;
use App\Repository\RestaurationRepository;
use App\Repository\ReunionRepository;
use App\Repository\TacheRepository;
use SebastianBergmann\GlobalState\Snapshot;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/devis')]
class DevisController extends AbstractController
{
    
    #[Route('/', name: 'app_devis_index', methods: ['GET'])]
    public function index(DevisRepository $devisRepository): Response
    {
        return $this->render('devis/index.html.twig', [
            'devis' => $devisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_devis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DevisRepository $devisRepository): Response
    {
        $devi = new Devis();
        $form = $this->createForm(DevisType::class, $devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisRepository->save($devi, true);

            return $this->redirectToRoute('app_devis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis/new.html.twig', [
            'devi' => $devi,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'app_devis_show', methods: ['GET'])]
    public function show(Devis $devi,Request $request,ProblemeRepository $problemeRepository): Response
    {
        
        
        return $this->renderForm('devis/show.html.twig', [
            'devi' => $devi,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_devis_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Devis $devi,
        DevisRepository $devisRepository,
        AccompteRepository $accompteRepository,
        DevisPrestationRepository $devisPrestationRepository,
        OuvertureDossierRepository $ouvertureDossierRepository,
        DevisDeplacementRepository $devisDeplacementRepository,
        DevisHebergementRepository $devisHebergementRepository,
        DevisReunionRepository $devisReunionRepository,
        DevisRestaurationRepository $devisRestaurationRepository
        ): Response
        {
            
            // edit devis
            
            $form = $this->createForm(DevisEditType::class, $devi);
            
            
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $devi->setMission($devi->getMission());
                $devisRepository->save($devi, true);
                
                return $this->redirectToRoute('app_devis_edit', ['id' => $devi->getId()], Response::HTTP_SEE_OTHER);
            }
            // edit devis
            
            //ajouter une prestation
                $totalPrestation = 0 ;

                $tabPrestation = $devisPrestationRepository->findBy(['devis' => $devi])  ;
                foreach ($tabPrestation as $p) {
                    $totalPrestation += $p->getQuantite() * $p->getPrix() ;
                }
                
                $devisPrestation = new DevisPrestation();
                $formPrestation = $this->createForm(DevisPrestationType::class, $devisPrestation);
                $formPrestation->handleRequest($request);
        
                if ($formPrestation->isSubmitted() && $formPrestation->isValid()) {
                    $devisPrestation->setDevis($devi);
                    $devisPrestationRepository->save($devisPrestation, true);
                    return $this->redirectToRoute('app_devis_edit', ['id' => $devi->getId()], Response::HTTP_SEE_OTHER);
                }
        
            //ajouter une prestation

            //Ajouter formulaire ouverture de dossier 
            $ouvertureDossier = new OuvertureDossier();
        $formOuverture = $this->createForm(OuvertureDossierType::class, $ouvertureDossier);
        $formOuverture->handleRequest($request);
        
        if ($formOuverture->isSubmitted() && $formOuverture->isValid()) {
            $ouvertureDossier->setDevis($devi);
            $ouvertureDossierRepository->save($ouvertureDossier, true);
            return $this->redirectToRoute('app_devis_edit', ['id' => $devi->getId()], Response::HTTP_SEE_OTHER);
        }
        
        //Ajouter formulaire ouverture de dossier 
        
        //Ajouter un accompte
        
        $accompte = new Accompte() ; 
        $formAccompte = $this->createForm(AccompteType::class , $accompte);
        $formAccompte->handleRequest($request);
        if ($formAccompte->isSubmitted() && $formAccompte->isValid()) {
            $accompte->setDevis($devi);
            $accompteRepository->save($accompte, true);
            return $this->redirectToRoute('app_devis_edit', ['id' => $devi->getId()], Response::HTTP_SEE_OTHER);
            }
        
        $totalAcompte = 0 ;
        
        $tabAccompte = $accompteRepository->findBy(['devis'=>$devi]);

        foreach ($tabAccompte as $a) {
            if( $a->isPayer() ){
                $totalAcompte += 0 ;  
            }
            else{
                $totalAcompte += $a->getPrix() ;  
            }
        }

        

        //Ajouter un accompte


        //Ajouter formulaire déplacements
            $totalDeplacements = 0 ;

            $tabDeplacements = $devisDeplacementRepository->findBy(['devis'=>$devi]);
            foreach ($tabDeplacements as $d) {
                $totalDeplacements += $d->getQuantite() * $d->getPrix();
            }
            //dd($totalDeplacements);
            $deplacement = new DevisDeplacement();
            $formDeplacement = $this->createForm(DevisDeplacementType::class, $deplacement);
            $formDeplacement->handleRequest($request);

            if ($formDeplacement->isSubmitted() && $formDeplacement->isValid()) {
                $deplacement->setDevis($devi);
                $devisDeplacementRepository->save($deplacement, true);
    
                return $this->redirectToRoute('app_devis_edit', ['id' => $devi->getId()], Response::HTTP_SEE_OTHER);
            }
        //Ajouter formulaire déplacements
        
        //Ajouter formulaire hébergements


            $devisHebergement = new DevisHebergement();
            $formHebergement = $this->createForm(DevisHebergementType::class, $devisHebergement);
            $formHebergement->handleRequest($request);

            if ($formHebergement->isSubmitted() && $formHebergement->isValid()) {
                $devisHebergement->setDevis($devi);
                $devisHebergementRepository->save($devisHebergement, true);

                return $this->redirectToRoute('app_devis_edit', ['id' => $devi->getId()], Response::HTTP_SEE_OTHER);
            }

        //Ajouter formulaire hébergements

        //Ajouter formulaire reunion
            $devisReunion = new DevisReunion();
            $formReunion = $this->createForm(DevisReunionType::class, $devisReunion);
            $formReunion->handleRequest($request);

            if ($formReunion->isSubmitted() && $formReunion->isValid()) {
                $devisReunion->setDevis($devi);
                $devisReunionRepository->save($devisReunion, true);

                return $this->redirectToRoute('app_devis_edit', ['id' => $devi->getId()], Response::HTTP_SEE_OTHER);
            }
        //Ajouter formulaire reunion

        //Ajouter formulaire restauration
            $devisRestauration = new DevisRestauration();
            $formRestauration = $this->createForm(DevisRestaurationType::class, $devisRestauration);
            $formRestauration->handleRequest($request);

            if ($formRestauration->isSubmitted() && $formRestauration->isValid()) {
                $devisRestauration->setDevis($devi);
                $devisRestaurationRepository->save($devisRestauration, true);

                return $this->redirectToRoute('app_devis_edit', ['id' => $devi->getId()], Response::HTTP_SEE_OTHER);
            }
        //Ajouter formulaire restauration


        
        return $this->renderForm('devis/edit.html.twig', [
            'devi' => $devi,
            'form' => $form,
            'formOuverture' => $formOuverture,
            'formDeplacement' => $formDeplacement,
            'formHebergement' => $formHebergement,
            'formReunion' => $formReunion,
            'formRestauration' => $formRestauration,
            'formPrestation' => $formPrestation,
            'totalPrestation' => $totalPrestation,
            'formAccompte' => $formAccompte,
            'totalAcompte' => $totalAcompte,
            'totalDeplacements' => $totalDeplacements,
        ]);
    }
    
    #[Route('/{id}/edit/pdf', name: 'app_devis_pdf', methods: ['GET', 'POST'])]
    public function pdf ( Devis $devi) {
        
        $adresses = $devi->getMission()->getContact()->getAdresses();

        // Get the full URL to the image
        $data = [
            'logo'  => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'),  
        ];
        if($adresses){
            array_push($data,$adresses);
        }
        
        $html = $this->renderView('devis/edit/_devispdf.html.twig', [
            'devis'=>$devi,
            'data'=>$data
        ]);
        
        $dompdf = new Dompdf();
        // Load the HTML into Dompdf
        $dompdf->loadHtml($html) ;

        // Set the base path for the PDF
        $dompdf->setBasePath($this->getParameter('kernel.project_dir') . '/public');
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $dompdf->render();
        
        // Output the generated PDF to Browser
        $dompdf->stream('Devis : '.$devi->getName(), ["Attachment" => true]);
        
        return $this->renderForm('devis/edit/_devispdf.html.twig', [
            'devis'=>$devi,
        ]);
    }
    
    
    #[Route('/{id}/edit/facture', name: 'app_devis_facture', methods: ['GET', 'POST'])]
    public function facture ( 
                            Devis $devi,
                            AccompteRepository $accompteRepository,
                            DevisHebergementRepository $devisHebergementRepository,
                            DevisDeplacementRepository $devisDeplacementRepository,
                            DevisPrestationRepository $devisPrestationRepository,
                            DevisRestaurationRepository $devisRestaurationRepository,
                            DevisReunionRepository $devisReunionRepository,
                            OuvertureDossierRepository $ouvertureDossierRepository,
                            ForfaitRepository $forfaitRepository,
                            ProblemeRepository $problemeRepository,
                            TacheRepository $tacheRepository,      
                            IntervenantRepository $intervenantRepository,  
                            HebergementRepository $hebergementRepository,   
                            DeplacementRepository $deplacementRepository,      
                            ReunionRepository $reunionRepository , 
                            RestaurationRepository $restaurationRepository,
                                  
                            ):Response 
    {
        $mission=$devi->getMission(); 
        // je recuperes tout les problemes     
        $tabProbleme= $problemeRepository->findBy(["mission" => $mission]) ;    
        $tabTaches= [];   
        $tabTaches2=[];

        foreach ($tabProbleme as $p) {
            $tabTaches[] = $tacheRepository->findBy(["probleme"=>$p]);
        }

        // J'ai un tableau propre de toutes les taches de la mission
        foreach ($tabTaches as $p) {
            foreach ($p as $t) {
                $tabTaches2 [] = $t;
            }
        }

        // J'ai un tableau propre de toutes les taches de la mission

        //Tabtache2 est mon tableau de taches

        //je veux trouver le forfait de toutes ces taches   
        $forfaitList = [] ;
        $forfaitList2 =[] ;
        $intervenantList = [] ;
        $intervenantList2 = [] ;
        $totalIntervenant = 0 ;
        $hebergementList =[];
        $deplacementList = [];
        $deplacementList2 = [];
        $restaurationList = [];
        $restaurationList2 = [];
        

                
        //je doit parcourir les taches
        foreach ($tabTaches2 as $tache) {
            // je trouves les forfais de mes taches
            $forfaitList[] = $forfaitRepository->findBy(["tache"=>$tache],['date'=>'ASC']);   
            $intervenantList[] = $intervenantRepository->findBy(["tache"=>$tache]);
            $hebergementList[] = $hebergementRepository->findBy(["tache"=>$tache],['date'=>'ASC']);
            $deplacementList[] = $deplacementRepository->findBy(["tache"=>$tache],['date'=>'ASC']);
            $reunionList[] = $reunionRepository->findBy(["tache"=>$tache],['date'=>'ASC']);
            $restaurationList[] = $restaurationRepository->findBy(["tache"=>$tache],['date'=>'ASC']) ;
            
        }
        // intervenants
        foreach ($intervenantList as $tache) {
            foreach ($tache as $i) {
                if( $i->isPayer() ){

                }
                else{
                    $intervenantList2[] = $i ;
                    $totalIntervenant += $i->getCout();
                }
            }
        }
        
        //forfaits
        $totalForfait = 0;
        foreach ($forfaitList as $tache) {
            foreach ($tache as $f) {
                $forfaitList2[] = $f;
                if( $f->isPayer() ){
                    $totalForfait += $f->getPrix();
                }
                else{
                    $totalForfait += 0; 
                }

            }
        }

        
        //accompte
        $totalAccompte = 0 ;
        $tabAccompte = $accompteRepository->findBy(['devis'=>$devi]) ;

        foreach ($tabAccompte as $a) {
            if ( $a->isPayer() ) {
                $totalAccompte += 0 ;
            }
            else{
                $totalAccompte += $a->getPrix() ;
            }
        }
        
        //ouverture de dossier
        $totalOuvertureDeDossier = 0 ;
        $tabOuvertureDeDossier = $ouvertureDossierRepository->findBy(["devis" => $devi]);

        foreach ($tabOuvertureDeDossier as $d ) {

            $totalOuvertureDeDossier += $d->getQuantite() * $d->getPrix() ;
        }

        //DevisPrestations
        $DevisPrestations = $devisPrestationRepository->findBy(["devis" => $devi]);
        $totalDevisPrestation = 0 ;
        foreach ($DevisPrestations as $d) {
            $totalDevisPrestation += $d->getQuantite() * $d->getPrix(); 
        }

        // total des devis hebergements 
        $devisHebergements= $devisHebergementRepository->findBy( ['devis' => $devi]  ) ;
        $totalDevisHebergements = 0 ; 

        foreach ($devisHebergements as $h) {
            $totalDevisHebergements += $h->getQuantite() * $h->getPrixUnitaire();
        }
        // total liste des hebergements réels

        $hebergementList2 = [];
        
        foreach ($hebergementList as $t) {
            foreach ($t as $h) {
                $hebergementList2[] = $h;
            }
        }
        $totalHebergements = 0 ;
        foreach ($hebergementList2 as $h) {
            if( $h->isPayer() ){
            }
            else{
                $totalHebergements += $h->getNuit() * $h->getCoutNuitUnitaire();
            }
        }

        

        foreach ($deplacementList as $t) {
            foreach ($t as $d) {
                $deplacementList2[] = $d;  
            }
        }
        
        // total des déplacements non reglés
        $totalDéplacements = 0;
        foreach ($deplacementList2 as $d) {
            if($d->isPayer()){
                $totalDéplacements += 0 ;
            }
            else{
                $totalDéplacements += $d->getCout() + $d->getCoutPeage() + $d->getCoutCarburant();
            }
        }

        //reunion Table
        $ReunionList2 = [];
        foreach ($reunionList as $t) {
            foreach ($t as $r) {
                $ReunionList2[] = $r;
            }
        }
        $totalReunion = 0;
        foreach ($ReunionList2 as $r) {
            if( $r->isPayer() ) {
                
            }
            else{
                $totalReunion += $r->getCoutLocationSalle() + $r->getCoutLocationMateriel() + $r->getCoutRestauration() + $r->getcoutCollation() + $r->getforfaitHoraire()  ;
            }
        }

        // restaurationTable
        foreach ($restaurationList as $t) {
                foreach ($t as $r) {
                    $restaurationList2[] = $r;  
                }    
        }
        $totalRestauration = 0 ;

        foreach ($restaurationList2 as $r) {
            if( $r->isPayer() )
            {
                $totalRestauration += 0 ;
            }
            else{
                $totalRestauration += $r->getCoutRepasPersonnel() + $r->getCoutRepasClients() + $r->getForfait() ;
            }
        }

        // Liste des forfaits
        
        $totalFacture = $totalForfait + $totalAccompte + $totalOuvertureDeDossier + $totalReunion + $totalRestauration + $totalDéplacements + $totalHebergements + $totalIntervenant;
        $tva = $totalFacture * 0.2 ;
        $ttc = $totalFacture + $tva ;



        $data = [
            'logo'  => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'),
            'mission' => $mission ,
            'devis'=>[

                'ouvertureDossier' => $tabOuvertureDeDossier ,
                'totalOuvertureDeDossier' => $totalOuvertureDeDossier,
                'DevisPrestations' => $DevisPrestations,
                'TotalDevisPrestations'=> $totalDevisPrestation ,
                'DevisHebergements' => $devisHebergements ,
                'totalDevisHebergements' => $totalDevisHebergements,
                'DevisDeplacement' => $devisDeplacementRepository->findBy(["devis" => $devi]),
                'devisRestaurations' => $devisRestaurationRepository->findBy(["devis" => $devi]),
                'devisReunions' => $devisReunionRepository->findBy(["devis" => $devi]),
                'tabAccompte' => $tabAccompte ,
                'totalAcompte' => $totalAccompte,
            ],
            'TabProblemes' => $tabProbleme ,
            'taches'=>[
                'tabTaches'=>$tabTaches2,
                'forfaitList'=>$forfaitList2,
                'totalForfait'=> $totalForfait,
                'intervenantList' => $intervenantList2,
                'totalIntervenant' => $totalIntervenant,
                'hebergementList' => $hebergementList2,
                'totalHebergements' => $totalHebergements,
                'deplacementList' => $deplacementList2,
                'totalDéplacements' => $totalDéplacements,
                'ReunionList' => $ReunionList2,
                'totalReunion' => $totalReunion ,
                'restaurationList' => $restaurationList2 ,
                'totalRestauration' => $totalRestauration,
            ],
            'totalFacture' => $totalFacture,
            'tva'=>$tva,
            'ttc'=>$ttc,
        ];
        
        $html = $this->renderView('devis/edit/facture/facturePdf.html.twig', [
            'devis'=>$devi,
            'data'=>$data
        ]);
        
        $dompdf = new Dompdf();
        // Load the HTML into Dompdf
        $dompdf->loadHtml($html) ;
        
        // Set the base path for the PDF
        $dompdf->setBasePath($this->getParameter('kernel.project_dir') . '/public');
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $dompdf->render();
        
        // Output the generated PDF to Browser
        $dompdf->stream('facture : '.$devi->getName() , ["Attachment" => false]);
  
        
        return $this->renderForm('devis/edit/facture/facturePdf.html.twig', [
            'devis'=>$devi,
            'data'=>$data,
        ]);
        
    }
   
    

    private function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    #[Route('/{id}', name: 'app_devis_delete', methods: ['POST'])]
    public function delete(Request $request, Devis $devi, DevisRepository $devisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devi->getId(), $request->request->get('_token'))) {
            $devisRepository->remove($devi, true);
        }

        return $this->redirectToRoute('app_mission_edit', ['id' => $devi->getMission()->getId()], Response::HTTP_SEE_OTHER);
    }
    
}
