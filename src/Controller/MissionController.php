<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Devis;
use App\Entity\Forfait;
use App\Entity\Mission;
use App\Entity\Probleme;
use App\Form\MissionType;
use App\Entity\EtatDesLieux;
use App\Form\EditForfaitType;
use App\Form\NoteDeFraisType;
use App\Form\DevisMissionType;
use App\Form\NoteDeFraisPdfType;
use App\Form\ProblemeMissionType;
use App\Repository\DevisRepository;
use App\Repository\TacheRepository;
use App\Repository\AdresseRepository;
use App\Repository\ForfaitRepository;
use App\Repository\MissionRepository;
use App\Repository\ProduitRepository;
use App\Repository\ReunionRepository;
use App\Repository\DocumentRepository;
use App\Repository\ProblemeRepository;
use App\Repository\DeplacementRepository;
use App\Repository\HebergementRepository;
use App\Repository\IntervenantRepository;
use App\Form\PayerToutesLesNotesTypesType;
use App\Repository\EtatDesLieuxRepository;
use App\Repository\RestaurationRepository;
use App\Repository\CommunicationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/mission')]
class MissionController extends AbstractController
{
    #[Route('/', name: 'app_mission_index', methods: ['GET'])]
    public function index(MissionRepository $missionRepository): Response
    {
        return $this->render('mission/index.html.twig', [
            'missions' => $missionRepository->findAll(),
        ]);
    }
    
    #[Route('/new', name: 'app_mission_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MissionRepository $missionRepository): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);
            
            return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->renderForm('mission/new.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'app_mission_show', methods: ['GET'])]
    public function show(Mission $mission): Response
    {
        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_mission_edit', methods: ['GET', 'POST'])]
    public function edit( Mission $mission, DocumentRepository $documentRepository,RestaurationRepository $restaurationRepository ,ReunionRepository $reunionRepository ,Request $request,  MissionRepository $missionRepository,ProblemeRepository $problemeRepository,DevisRepository $devisRepository,TacheRepository $tacheRepository,ForfaitRepository $forfaitRepository,DeplacementRepository $deplacementRepository,HebergementRepository $hebergementRepository,CommunicationRepository $communicationRepository,IntervenantRepository $intervenantRepository): Response
    {
        $session = $request->getSession();
        $data=[];
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $missionRepository->save($mission, true);
            
            return $this->redirectToRoute('app_mission_edit', [ 'id'=> $mission->getId()], Response::HTTP_SEE_OTHER);
        }
        $formNoteDeFraisPdf = $this->createForm(NoteDeFraisPdfType::class);
        $formNoteDeFraisPdf->handleRequest($request);
        
        /* Ajouter un probleme */
        $probleme = new Probleme();
        $formProb = $this->createForm(ProblemeMissionType::class, $probleme); 
        $formProb->handleRequest($request);
        
        if ($formProb->isSubmitted() && $formProb->isValid()) {
            $probleme->setMission($mission);
            $problemeRepository->save($probleme, true);
            
            return $this->redirectToRoute('app_mission_edit', [ 'id'=> $mission->getId()], Response::HTTP_SEE_OTHER);
        }
        /* Ajouter un probleme */
        
        /* Ajouter un Devis */
        $devis=new Devis();
        $formDevis= $this->createForm(DevisMissionType::class,$devis);
        $formDevis->handleRequest($request);
        
        $taches =[];
        $problemeList = $problemeRepository->findBy(['mission'=>$mission]);  // Je récupères les problèmes
        
        // Je récupères les problèmes
        $tacheTabClean=[];
        foreach ($problemeList as $p) {
            $taches[]=$tacheRepository->findBy(["probleme"=>$p]);
        }
        foreach ($taches as $p) {
            foreach ($p as $t) {
                $tacheTabClean[]=$t;
            } 
        }
        // $tacheTabClean est un tableau propre de tout les problèmes
        
        
        
        if ($formDevis->isSubmitted() && $formDevis->isValid()) {
            $devis->setMission($mission);
            $devisRepository->save($devis, true);
            
            return $this->redirectToRoute('app_mission_edit', [ 'id'=> $mission->getId()], Response::HTTP_SEE_OTHER);
        }
        /* Ajouter un Devis */
        
        
        /* Je crée un formulaire de saisie pour choisir le mois et l'année */
        
        $formNoteDeFrais = $this->createForm(NoteDeFraisType::class);
        $formNoteDeFrais->handleRequest($request);
        
        
        //obtenir la valeur du form envoyé
        $month = $formNoteDeFrais->get('month')->getData();
        
        $year=$formNoteDeFrais->get('year')->getData();
        
        
        
        $deplacements=[];
        $hebergements= [];
        $reunionTab1 = [];
        $restaurationTab= [];
        $forfaitTab2 = [];
        $communicationTab=[];
        $intervenantTab = [];
        $documentTab =[];
        $forfaitTab = [];
        
        if($problemeList){ 
            
            foreach ($problemeList as  $probleme) { // Je parcours le tableau des problemes
                
                
                $tacheTab= $tacheRepository->findBy(["probleme" => $probleme]); // Tableau des taches d'un probleme
                
                if($tacheTab){ //Si il y a des taches je parcours le tableau
                    
                    $forfaitTab = [] ;
                    foreach ($tacheTab as $tache) { //je parcours le tableau des taches
                        
                        
                        //on vas chercher les forfaits
                        $forfait= $forfaitRepository->findBy(["tache"=> $tache]);
                        
                        foreach ($forfait as $f) {
                            $forfaitTab[] = $f ;
                        }
                        
                        
                        //je parcours le tableau des forfaits
                        
                        // on vas chercher les intervanants
                        $intervenant=$intervenantRepository->findBy(["tache"=> $tache]);
                        
                        foreach ($intervenant as $i) {
                            $intervenantTab[] = $i;
                        }
                        $session->set('intervenantTab', $intervenantTab);
                        // on vas chercher les intervanants
                        // on vas chercher les documments
                        
                        $document= $documentRepository->findBy(["tache"=> $tache]);
                        
                        foreach ($document as $d){
                            $documentTab[] = $d;
                            
                        }
                        // on vas chercher les documments
                        
                        
                        //on vas chercher les intervenants
                        $intervenant= $intervenantRepository->findBy(
                            ["tache"=> $tache]
                        );
                       
                        //on vas chercher les intervenants
                        
                        
                        // on vas chercher les déplacements 
                        $deplTab= $deplacementRepository->findBy(
                            ["tache" => $tache]
                        );
                        
                        
                        // je parcours le tableau 
                        foreach ($deplTab as $dep) {
                            
                            $deplacements[] = $dep;
                            
                        };
                        // on vas chercher les déplacements 
                        
                        // on vas chercher les hébergements
                        $hebergement = $hebergementRepository->findBy(
                            ["tache" => $tache]
                        );
                        
                        foreach ($hebergement as $h) {
                            
                            $hebergements[] = $h;
                            
                        };
                        // on vas chercher les hébergements
                        
                        // on vas chercher les reunions
                        $reunion = $reunionRepository->findBy(
                            ["tache" => $tache]
                        ); 
                        foreach ($reunion as $r) {
                            $reunionTab1[] = $r;
                        }
                        
                        
                        // on vas chercher les reunions
                        
                        // on vas chercher les communications
                        $communication = $communicationRepository->findBy(
                            ["tache" => $tache]
                        );
                        
                        foreach( $communication as $c ){
                            $communicationTab[] = $c;
                            
                        }
                        // on vas chercher les communications
                        
                        
                        // on vas chercher les restaurations
                        
                        $restauration = $restaurationRepository->findBy(
                            ["tache" => $tache ],
                            ) ;
                            foreach ($restauration as $r) {
                                $restaurationTab[] = $r ;
                            }
                            // on vas chercher les restaurations
                            
                        }
                        
                    }
                    
                }
            }
            
            // j'envoies mes données au controlleur note de frais 
            if ($formNoteDeFrais->isSubmitted() && $formNoteDeFrais->isValid()) {   
                
                
                
                $totalHt= 0 ;
                //intervenants
                $intervenantTab2=[];
                $totalIntervenants = 0 ;
                foreach ($intervenantTab as $i) {
                    if($i->getDate()->format("m") == $month && $i->getDate()->format("Y") == $year ) {
                        
                        $intervenantTab2[] = $i;
                        if( $i->isPayer() ){
                            $totalIntervenants += 0 ;
                        }
                        else{
                            $totalIntervenants += $i->getCout() ;
                        }
                        
                    }
                }
                $totalHt += $totalIntervenants ;
                //intervenants
                
                //documents
                $documentTab2 = [];
                $totalDocuments = 0 ; 
                foreach ($documentTab as $i) {
                    if($i->getDate()->format("m") == $month && $i->getDate()->format("Y") == $year ) {
                        
                        $documentTab2[] = $i;
                        if( $i->isPayer() ){
                            $totalDocuments += 0 ;
                        }
                        else{
                            $totalDocuments += $i->getCoutAchatDocument() + $i->getCoutDocumentCommande() + $i->getCoutDocumentProduit();
                        }  
                        
                    }
                }
                $totalHt += $totalDocuments ;
                
                
                //documents
                
                //communications
                $comTab3 = [];
                $totalCom = 0 ;
                
                foreach ($communicationTab as $c) {
                    if($c->getDate()->format("m") == $month && $c->getDate()->format("Y") == $year ) {
                        
                        $comTab3[] = $c;
                        $totalCom += $c->getForfait();
                        
                    }
                } 
                $totalHt += $totalCom;
                //communications
                
                //forfaits
                
                $forfaitTab3=[];
                $totalForfait = 0 ;
                
                foreach ($forfaitTab as $f) {
                    if($f->getDate()->format("m") == $month && $f->getDate()->format("Y") == $year ) {  
                        $forfaitTab3[] = $f;
                        if( $f->isPayer() ){
                            $totalForfait += 0 ;
                        }
                        else{
                            $totalForfait += $f->getPrix(); 
                        }
                    }
                    
                    
                }
                $totalHt += $totalForfait ;
                //forfaits
                
                
                //déplacements
                $deplacementsTab= [];
                $totalDeplacment = 0 ;
                
                
                foreach ($deplacements as $d) {
                    
                    if($d->getDate()->format("m") == $month && $d->getDate()->format("Y") == $year ) {
                        
                        $deplacementsTab[] = $d;
                        if( $d->isPayer() ){
                            $totalDeplacment += 0 ;     
                        }
                        else{
                            $totalDeplacment += $d->getCout() + $d->getCoutPeage() + $d->getCoutCarburant();
                        }
                    }
                    
                }
                $totalHt += $totalDeplacment;
                //déplacements
                
                //hébergements
                $hebergementTab= [] ;
                $totalHebergement = 0 ;
                
                foreach ($hebergements as $h) {
                    
                    if($h->getDate()->format("m") == $month && $h->getDate()->format("Y") == $year ) {
                        $hebergementTab[] = $h;
                        if($h->isPayer()){
                            $totalHebergement += 0 ;  
                        }
                        else{
                            $totalHebergement += $h->getNuit() * $h->getCoutNuitUnitaire();
                        }
                    }
                    
                }
                $totalHt += $totalHebergement ;
                
                //hébergements
                
                //reunions
                
                $reunionTab2=[];
                $totalReunions = 0;
                
                foreach ($reunionTab1 as $r) {
                    if($r->getDate()->format("m") == $month && $r->getDate()->format("Y") == $year ){
                        $reunionTab2[] = $r;
                        if( $r->isPayer() ){
                            $totalReunions += 0 ;
                        }
                        else{
                            $totalReunions += $r->getForfaitHoraire() + $r->getCoutLocationSalle() + $r->getCoutLocationMateriel() + $r->getCoutRestauration() + $r->getCoutCollation() ; 
                        }
                        
                    }
                }
                
                $totalHt += $totalReunions ;
                
                //reunions
                
                //restaurations
                
                $rTab = [] ;
                $totalrestaurations = 0 ;
                
                foreach ($restaurationTab as $r) {
                    
                    if($r->getDate()->format("m") == $month && $r->getDate()->format("Y") == $year ){
                        $rTab[] = $r;
                        if( $r->isPayer() ){
                            $totalrestaurations += 0;
                        }
                        else{
                            $totalrestaurations += $r->getForfait() + $r->getCoutRepasPersonnel() + $r->getCoutRepasClients();
                        }
                    } 
                }
                $totalHt += $totalrestaurations ;
                //restaurations
                
                
                // formulaire pour les regler tous
                $formPayAll = $this->createForm(PayerToutesLesNotesTypesType::class);
                $formPayAll->handleRequest($request);
                
                
                $tva = $totalHt * 0.20 ;
                $ttc = $totalHt + $tva ;
                // formulaire pour les regler tous
                        $session = $request->getSession();
                        
                        $adresses = $mission->getContact()->getAdresses() ;
                        $adresse =  0 ;
                        foreach ($adresses as $a) {
                            if($a->isFacturation() ){
                                $adresse = $a ;
                            }
                        }
                        $session->set('mission', $mission);
                        $session->set('month', $month);
                        $session->set('year', $year);
                        $session->set('logo', $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'));
                        $session->set('deplacements' , $deplacementsTab );
                        $session->set('totalDeplacment' , $totalDeplacment );
                        $session->set('hebergements' , $hebergementTab );
                        $session->set('forfaits' , $forfaitTab3 );
                        $session->set('totalForfait' , $totalForfait );
                        $session->set('reunions' , $reunionTab2 );
                        $session->set('totalReunions' , $totalReunions );
                        $session->set('restaurations' , $rTab );
                        $session->set('intervenantTab',$intervenantTab2);
                        $session->set('documents',$documentTab2);
                        $session->set('totalDocuments',$totalDocuments);
                        $session->set('totalrestaurations',$totalrestaurations);
                        $session->set('forfaits', $forfaitTab3);
                        $session->set('communications',$comTab3);
                        $session->set('totalCom',$totalCom);
                        $session->set('totalIntervenants',$totalIntervenants,);
                        $session->set('totalForfait' , $totalForfait);
                        $session->set('totalHt' , $totalHt);
                        $session->set('tva',$tva);
                        $session->set('ttc',$ttc);
                        $session->set('contact' , $mission->getContact() );
                        $session->set('adresse' , $adresse);
                        
                        
                        
                        /*
                        return $this->redirectToRoute('app_mission_note_index_edit', [
                            'tacheTab'=>$session->get('tacheTab'),
                            'formPayAll'=>$session->get('formPayAll'),
                            'page'=> 'mission',
                            'year'=>$session->get('year'),
                            'mission'=>$session->get('mission'),
                            'month'=>$session->get('month'),
                            'deplacements'=>$session->get('deplacements'),
                            'totalDeplacment'=>$session->get('totalDeplacement'),
                            'hebergements'=>$session->get('hebergements'),
                            'reunions'=>$session->get('reunions'),
                            'totalReunions'=>$session->get('totalReunions'),
                            'restaurations'=>$session->get('restaurations'),
                            'documents'=>$session->get('documents'),
                            'totalDocuments'=>$session->get('totalDocuments'),
                            'totalrestaurations'=>$session->get('totalRestaurations'),
                            'forfaits'=> $session->get('forfaits'),
                            'communications'=>$session->get('communications'),
                            'totalCom'=>$session->get('totalCom'),
                            'intervenants'=>$session->get('intervenantTab'),
                            'totalIntervenants'=>$session->get('totalIntervenants'),
                            'totalForfait' => $session->get('totalForfait'),
                            'totalHt' => $session->get('totalHt'),
                            'tva'=>$session->get('tva'),
                            'ttc'=>$session->get('ttc'),
                            'logo'  => $session->get('logo'),  
                            'year' => $year,
                            'formNoteDeFraisPdf'=> $formNoteDeFraisPdf,  
                        ], Response::HTTP_SEE_OTHER);

                        */
                            return $this->renderForm('mission/edit/notedefrais/index.html.twig', [ 
                                'tacheTab'=>$session->get('tacheTab'),
                                'formPayAll'=>$session->get('formPayAll'),
                                'page'=> 'mission',
                                'year'=>$session->get('year'),
                                'mission'=>$session->get('mission'),
                                'month'=>$session->get('month'),
                                'deplacements'=>$session->get('deplacements'),
                                'totalDeplacment'=>$session->get('totalDeplacement'),
                                'hebergements'=>$session->get('hebergements'),
                                'reunions'=>$session->get('reunions'),
                                'totalReunions'=>$session->get('totalReunions'),
                                'restaurations'=>$session->get('restaurations'),
                                'documents'=>$session->get('documents'),
                                'totalDocuments'=>$session->get('totalDocuments'),
                                'totalrestaurations'=>$session->get('totalRestaurations'),
                                'forfaits'=> $session->get('forfaits'),
                                'communications'=>$session->get('communications'),
                                'totalCom'=>$session->get('totalCom'),
                                'intervenants'=>$session->get('intervenantTab'),
                                'totalIntervenants'=>$session->get('totalIntervenants'),
                                'totalForfait' => $session->get('totalForfait'),
                                'totalHt' => $session->get('totalHt'),
                                'tva'=>$session->get('tva'),
                                'ttc'=>$session->get('ttc'),
                                'logo'  => $session->get('logo'),  
                                'year' => $year,
                                'formNoteDeFraisPdf'=> $formNoteDeFraisPdf, 
                                ]) ;     
                            }
                            
                            return $this->renderForm('mission/edit.html.twig', [
                                'mission' => $mission,
                                'form' => $form,
                                'formProb' => $formProb,
                                'formDevis' => $formDevis,
                                'formNoteDeFraisButton' => $formNoteDeFrais,
                                'formNoteDeFrais'=> $formNoteDeFrais, 
                                'formNoteDeFraisPdf'=> $formNoteDeFraisPdf, 
                                'tacheTab'=>$tacheTabClean,
                                'taches'=>$taches,
                                'problemeList'=>$problemeList,
                    ]);
                }

                #[Route('/note1/index', name: 'app_mission_note_index_edit', methods: ['GET', 'POST'])]
                public function indexEdit (Request $request,MissionRepository $missionRepository,AdresseRepository $adresseRepository) :Response
                {   
                    $session = $request->getSession();
                    return $this->renderForm('mission/edit/notedefrais/index.html.twig', [
                        'month'=> $session->get('month'), 
                        'year'=> $session->get('year'),
                        'mission'=>$session->get('mission'),
                        'forfaits' => $session->get('forfaits'),
                        'deplacements' => $session->get('deplacements'),
                        'hebergements' => $session->get('hebergements'),
                        'intervenants' => $session->get('intervenants'),
                        'communications' => $session->get('communications'),
                        'restaurations' => $session->get('restaurations'),
                        'reunions' => $session->get('reunions'),
                        'documents' => $session->get('documents'),
                        'totalHt' => $session->get('totalHt'),
                        'tva' => $session->get('tva'),
                        'ttc' => $session->get('ttc'),
                        'totalForfait' => $session->get('totalForfait' ),
                        'totalCom' => $session->get('totalCom'),
                        'totalrestaurations'=> $session->get('totalrestaurations'),
                        'totalReunions' => $session->get('totalreunions'),
                        'contact' => $session->get('contact'),
                        'adresse' => $session->get('adresse'),
                    ]);
                }

                
                #[Route('/note1/pdf', name: 'app_mission_note_pdf_edit', methods: ['GET', 'POST'])]
                public function pdf (Request $request,MissionRepository $missionRepository,AdresseRepository $adresseRepository) :Response
                {

                    $session = $request->getSession();
                    
                    
                    $mission = $session->get('mission');
                    $adresses= $adresseRepository->findBy(['contact'=> $mission->getContact()]);

                    
                    
                    $html = $this->renderView('mission/edit/notedefrais/pdf/pdf.html.twig', [      
                        'logo' => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'), 
                        'month'=> $session->get('month'), 
                        'year'=> $session->get('year'),
                        'mission'=>$session->get('mission'),
                        'adresses'=>$adresses,
                        'forfaits' => $session->get('forfaits'),
                        'deplacements' => $session->get('deplacements'),
                        'hebergements' => $session->get('hebergements'),
                        'intervenants' => $session->get('intervenants'),
                        'communications' => $session->get('communications'),
                        'restaurations' => $session->get('restaurations'),
                        'reunions' => $session->get('reunions'),
                        'documents' => $session->get('documents'),
                        'totalHt' => $session->get('totalHt'),
                        'tva' => $session->get('tva'),
                        'ttc' => $session->get('ttc'),
                        'totalForfait' => $session->get('totalForfait' ),
                        'totalCom' => $session->get('totalCom'),
                        'totalrestaurations'=> $session->get('totalrestaurations'),
                        'totalReunions' => $session->get('totalreunions'),
                        'contact' => $session->get('contact'),
                        'adresse' => $session->get('adresse'),
                       
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
                    $dompdf->stream('Note de frais : ' . $mission->getName() . " - période : ". $session->get('month') ." - " . $session->get('year')   , ["Attachment" => 0 ]);
                    return $this->renderForm('mission/edit/notedefrais/pdf/pdf.html.twig', [
                        
                        'month'=> $session->get('month'), 
                        'year'=> $session->get('year'),
                        'mission'=>$mission,
                        'adresses'=>$adresses,
                        'logo' => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'), 
                        'forfaits' => $session->get('forfaits'),
                        'deplacements' => $session->get('deplacements'),
                        'hebergements' => $session->get('hebergements'),
                        'intervenants' => $session->get('intervenants'),
                        'communications' => $session->get('communications'),
                        'restaurations' => $session->get('restaurations'),
                        'reunions' => $session->get('reunions'),
                        'documents' => $session->get('documents'),
                        'totalHt' => $session->get('totalHt'),
                        'tva' => $session->get('tva'),
                        'ttc' => $session->get('ttc'),
                    ]);
                }  
                /* Fin edit controller*/

                
                /* edit note de frais forfait */
                #[Route('{id}/edit/forfait/note', name: 'app_mission_edit_note_forfait', methods: ['GET', 'POST'])]
                public function editForfait (Request $request,Forfait $forfait,ForfaitRepository $forfaitRepository) :Response
                {

                    $session = $request->getSession();
                    $form = $this->createForm(EditForfaitType::class, $forfait);
                    $form->handleRequest($request);
                    
                    if ($form->isSubmitted() && $form->isValid() ) {
                        $forfaitRepository->save($forfait, true);
                      
                        return $this->renderForm('mission/edit/notedefrais/index.html.twig', [ 
                            'tacheTab'=>$session->get('tacheTab'),
                            'formPayAll'=>$session->get('formPayAll'),
                            'page'=> 'mission',
                            'year'=>$session->get('year'),
                            'mission'=>$session->get('mission'),
                            'month'=>$session->get('month'),
                            'deplacements'=>$session->get('deplacements'),
                            'totalDeplacment'=>$session->get('totalDeplacement'),
                            'hebergements'=>$session->get('hebergements'),
                            'reunions'=>$session->get('reunions'),
                            'totalReunions'=>$session->get('totalReunions'),
                            'restaurations'=>$session->get('restaurations'),
                            'documents'=>$session->get('documents'),
                            'totalDocuments'=>$session->get('totalDocuments'),
                            'totalrestaurations'=>$session->get('totalRestaurations'),
                            'forfaits'=> $session->get('forfaits'),
                            'communications'=>$session->get('communications'),
                            'totalCom'=>$session->get('totalCom'),
                            'intervenants'=>$session->get('intervenantTab'),
                            'totalIntervenants'=>$session->get('totalIntervenants'),
                            'totalForfait' => $session->get('totalForfait'),
                            'totalHt' => $session->get('totalHt'),
                            'tva'=>$session->get('tva'),
                            'ttc'=>$session->get('ttc'),
                            'logo'  => $session->get('logo'),  
                            ]) ;     
                    
                    }

                    return $this->renderForm('forfait/edit.html.twig', [
                        'forfait' => $forfait,
                        'form' => $form,
                        
                    ]);



                }

                /* Fin edit forfait */

                /* FICHE PDF MISSION */
                #[Route('{id}/edit/fiche/mission', name: 'app_mission_edit_fiche_mission', methods: ['GET', 'POST'])]
                public function fichePdfMission (Mission $mission,Request $request,MissionRepository $missionRepository,ProduitRepository $produitRepository,ProblemeRepository $problemeRepository,TacheRepository $tacheRepository,IntervenantRepository $intervenantRepository , EtatDesLieuxRepository $etatDesLieuxRepository){
                    $session = $request->getSession();

                    $dompdf = new Dompdf();
                    // Load the HTML into Dompdf
                    $clientStatut = 0 ;  
                    if( $mission->getContact()->getstatut()->getStatut() === "Mandant"){
                        $clientStatut = $mission->getContact()->getstatut()->getStatut() ;
                             
                    }
                    else{
                        $clientStatut = " " ;  
                    }
                    

                    // liste des problemes 
                    $problemeList = $problemeRepository->findBy( 
                        ["mission" => $mission]
                    ); 

                    //récuperer la liste des taches par probleme
                    $tacheList= $tacheRepository->findBy(
                        ["probleme"=> $problemeList ]
                    );

                    //récuperer les intervenants de chaque tache
                    $intList = $intervenantRepository->findBy(
                        ["tache"=>$tacheList]
                    );
                   

                    //récuperer les états des lieux par produit 
                    /*
                    $EtatList = $etatDesLieuxRepository->findBy(
                        ["produit"=> $mission->getProduit() ] 
                    );
                    */
                    
                    // Liste des intervenants 
                    
                    
                    
                    /*
                    */
                    $html = $this->renderView('mission/edit/_ficheMissionPdf.html.twig', [      
                        'logo' => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'), 
                        'mission'=>$mission,
                        'statut'=>$clientStatut,
                        'intervenants' => $intList,
                        'tacheList'=>$tacheList,
                        'nom'=>$mission->getContact()->getNom(),
                        'prenom'=>$mission->getContact()->getPrenom(),
                        
                    ]);
                    ob_get_clean();
                    
                    $dompdf->loadHtml($html) ;
                    
                    // Set the base path for the PDF
                    $dompdf->setBasePath($this->getParameter('kernel.project_dir') . '/public');
                    
                    // (Optional) Setup the paper size and orientation
                    $dompdf->setPaper('A4', 'portrait');
                    
                    // Render the HTML as PDF
                    $dompdf->render();
                    // Output the generated PDF to Browser
                    
                    $dompdf->stream('Fiche Mission : ' . $mission->getName() , ["Attachment" => 0 ]);
                    
                    
                    return $this->renderForm('mission/edit/_ficheMissionPdf.html.twig', [
                        'logo' => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'), 
                        'mission'=>$mission,
                        'statut'=>$clientStatut,
                        'intervenants' => $intList,
                        'tacheList'=>$tacheList,
                        'nom'=>$mission->getContact()->getNom(),
                        'prenom'=>$mission->getContact()->getPrenom(),
                      
                    ]);

                }
                /* FICHE PDF MISSION */

                /* Fiche reporting */
                #[Route('{id}/edit/fiche/reporting/mission', name: 'app_reporting_mission_edit_fiche', methods: ['GET', 'POST'])]
                public function ficheReportingMission (Mission $mission,Request $request,MissionRepository $missionRepository,ProduitRepository $produitRepository){
                    $session = $request->getSession();
                    return $this->renderForm('mission/edit/ficheReporting.html.twig', [
                        'mission' => $mission,
                    ]);

                }

                /* Fiche reporting */

                /* Bon de prise en charge */

                #[Route('{id}/edit/BonDePriseEnCharge', name: 'app_bon_de_prise_en_charge_mission', methods: ['GET', 'POST'])]
                public function BonDePriseEnChargeMission (Mission $mission,Request $request):Response{
                    

                    $dompdf = new Dompdf();
                    $html = $this->renderView('mission/edit/bonDePriseEnCharge.html.twig', [      
                        'mission' => $mission, 
                    ]);

                    // Set the base path for the PDF
                    $dompdf->setBasePath($this->getParameter('kernel.project_dir') . '/public');

                    // Load the HTML into Dompdf
                    $dompdf->loadHtml($html);
                    
                                        
                    // (Optional) Setup the paper size and orientation
                    $dompdf->setPaper('A4', 'portrait');
                    
                    // Render the HTML as PDF
                    $dompdf->render();

                    ob_get_clean();
                    // Output the generated PDF to Browser
                    $dompdf->stream('Bon de prise en charge : '. $mission->getName() , ['Attachment' => false ]);

                    return $this->renderForm('mission/edit/bonDePriseEnCharge.html.twig', [
                        'mission' => $mission,
                        
                    ]);

                }

                /* Bon de prise en charge */

                /* Lettre de commande */

                #[Route('{id}/edit/lettre/de/commande', name: 'app_lettre_de_commande_mission', methods: ['GET', 'POST'])]
                public function lettreDeCommandeMission (Mission $mission,Request $request):Response{
                    
                    if($mission->getContact()){
                        $contact = $mission->getContact();
                    }
                    
                    /*
                    */
                    $dompdf = new Dompdf();
                    $html = $this->renderView('mission/edit/lettreDeCommande.html.twig', [      
                        'mission' => $mission, 
                        'contact' => $contact,
                    ]);

                    // Set the base path for the PDF
                    $dompdf->setBasePath($this->getParameter('kernel.project_dir') . '/public');

                    // Load the HTML into Dompdf
                    $dompdf->loadHtml($html);
                                        
                    // (Optional) Setup the paper size and orientation
                    $dompdf->setPaper('A4', 'portrait');
                    
                    // Render the HTML as PDF
                    $dompdf->render();
                    ob_get_clean();
                    // Output the generated PDF to Browser
                    $dompdf->stream('Lettre de commande : '. $mission->getName() , ['Attachment' => false ]);

                    return $this->renderForm('mission/edit/lettreDeCommande.html.twig', [
                        'mission' => $mission,
                        'contact' => $contact,
                    ]);

                }




                /* Lettre de commande */
            
                private function imageToBase64($path) {
                    $path = $path;
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    return $base64;
                }
                
                #[Route('/{id}', name: 'app_mission_delete', methods: ['POST'])]
                public function delete(Request $request, Mission $mission, MissionRepository $missionRepository): Response
                {
                    if ($this->isCsrfTokenValid('delete'.$mission->getId(), $request->request->get('_token'))) {
                        $missionRepository->remove($mission, true);
                    }
                    
                    return $this->redirectToRoute('app_mission_index', [], Response::HTTP_SEE_OTHER);
                }
}