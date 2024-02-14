<?php

namespace App\Controller;

use Dompdf\Dompdf;
use App\Entity\Analyse;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Entity\Historique;
use App\Entity\Intervenant;
use App\Entity\EtatDesLieux;
use App\Form\AnalyseProduitType;
use App\Form\EtatDesLieuxProduitType;
use App\Repository\AnalyseRepository;
use App\Repository\ProduitRepository;
use App\Form\EditHistoriqueProduitType;
use App\Form\NewIntervenantProduitType;
use App\Repository\HistoriqueRepository;
use App\Repository\IntervenantRepository;
use App\Repository\EtatDesLieuxRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\StatutEtatDesLieuxRepository;
use Proxies\__CG__\App\Entity\StatutEtatDesLieux;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, 
    Produit $produit, 
    ProduitRepository $produitRepository,
    IntervenantRepository $intervenantRepository,
    HistoriqueRepository $historiqueRepository,EtatDesLieuxRepository $etatDesLieuxRepository,AnalyseRepository $analyseRepository,StatutEtatDesLieuxRepository $statutEtatDesLieuxRepository): Response
    {

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        // formulaire pour ajouter un intervenant 
            $intervenant = new Intervenant();
            $formNewintervanant = $this->createForm(NewIntervenantProduitType::class, $intervenant);
            $formNewintervanant->handleRequest($request);

            if ($formNewintervanant->isSubmitted() && $formNewintervanant->isValid()) {
                $intervenant->setProduit($produit);
                
                $intervenantRepository->save($intervenant, true);

                return $this->redirectToRoute('app_produit_edit', ['id' => $produit->getId() ], Response::HTTP_SEE_OTHER);
            }
        // formulaire pour ajouter un intervenant



        if ($form->isSubmitted() && $form->isValid()) {

            $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_produit_edit', ['id' => $produit->getId() ], Response::HTTP_SEE_OTHER);
        }

        // ajouter un historique 
            $historique = new Historique();
            $formHistorique = $this->createForm(EditHistoriqueProduitType::class, $historique); 
            $formHistorique->handleRequest($request);
            $today = new \DateTimeImmutable('now');
            if ($formHistorique->isSubmitted() && $formHistorique->isValid()) {
                $historique->setProduit($produit);
                $historique->setCreatedAt($today);
                $historiqueRepository->save($historique, true);

                
            }
        // ajouter un historique

        //ajouter une analyse
        $analyse = new Analyse();
        $formAnalyse = $this->createForm(AnalyseProduitType::class,$analyse);
        $formAnalyse->handleRequest($request);
        if ($formAnalyse->isSubmitted() && $formAnalyse->isValid()) {
           $analyse->setProduit($produit);
           $analyseRepository->save($analyse,true);
    
        }

        //ajouter une analyse

        // ajouter un etat des lieux 
            $etatdeslieux = new EtatDesLieux();
            $formEtatDesLieux = $this->createForm(EtatDesLieuxProduitType::class, $etatdeslieux ) ;
            $formEtatDesLieux->handleRequest($request);
            if ($formEtatDesLieux->isSubmitted() && $formEtatDesLieux->isValid()){
                $etatdeslieux->setProduit($produit);
                $etatDesLieuxRepository->save($etatdeslieux, true);
            }

        // ajouter un etat des lieux

        

        $EtatsTab = $etatDesLieuxRepository->findBy( [ 'produit' => $produit ] , [ 'createdAt' => 'ASC' ] ) ;
        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'intervenants' => $intervenantRepository->findByProduit($produit),
            'form' => $form,
            'EtatsTab' =>  $EtatsTab ,
            'formNewintervanant' => $formNewintervanant ,
            'formHistorique' => $formHistorique,
            'formEtatDesLieux'=>$formEtatDesLieux,
            'formAnalyse'=>$formAnalyse,
            
        ]);

    }


    #[Route('/{id}/edit/pdf', name: 'app_produit_pdf', methods: ['GET', 'POST'])]
    public function pdf (Request $request, Produit $produit) {
        /*
        */
        $dompdf = new Dompdf();
        
        $html = $this->renderView('produit/edit/_pdf.html.twig', [
            'nom'=>$produit->getName(),
            'identification'=>$produit->getIdentification(),
            'etat'=>$produit->getEtat(),
            'localisation'=>$produit->getLocalisation(),
            'carTechniques' => $produit->getCarTechniques(),
            'carJuridiques' => $produit->getCarJuridiques(),
            'carCommerciales' => $produit->getCarCommerciales(),
            'environement' => $produit->getEnvironement(),
            'intervenants' => $produit->getIntervenants(),
            'historique' => $produit->getHistoriques(),
            'observation' => $produit->getObservation(),
            "analyses" =>$produit->getAnalyses(),
        ]);
        $dompdf->loadHtml($html) ;
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $dompdf->render();
        ob_get_clean();
        
        // Output the generated PDF to Browser
        $dompdf->stream('Fiche produit '.$produit->getName(),array('Attachment'=>0));
        
        
        return $this->renderForm('produit/edit/_pdf.html.twig', [
            'nom'=>$produit->getName(),
            'identification'=>$produit->getIdentification(),
            'etat'=>$produit->getEtat(),
            'localisation'=>$produit->getLocalisation(),
            'carTechniques' => $produit->getCarTechniques(),
            'carJuridiques' => $produit->getCarJuridiques(),
            'carCommerciales' => $produit->getCarCommerciales(),
            'environement' => $produit->getEnvironement(),
            'intervenants' => $produit->getIntervenants(),
            'historique' => $produit->getHistoriques(),
            'observation' => $produit->getObservation(),
            'analyses' =>$produit->getAnalyses(),
        ]);
    }

    #[Route('/{id}/edit/pdf/etatDesLieux', name: 'app_produit_pdf_etat_des_lieux', methods: ['GET', 'POST'])]
    public function pdfetatdeslieux (Request $request, Produit $produit,StatutEtatDesLieuxRepository $statutEtatDesLieuxRepository,EtatDesLieuxRepository $etatDesLieuxRepository) {
        
        $observations = $produit->getObservation();
       
        $missionTab = $produit->getMissions() ;
        //liste de tout les états 
        $EtatsTab = $etatDesLieuxRepository->findBy( [ 'produit' => $produit ] , [ 'createdAt' => 'ASC' ] ) ;
        
        $minDate = new \DateTime();
        
        foreach ($EtatsTab as $e) {
            if( $e->getcreatedAt() < $minDate ){ 
                $minDate = $e->getcreatedAt() ;
            }
        }
        
        
        $maxDate = $minDate ;
        
        foreach ($EtatsTab as $e) {
            if( $e->getcreatedAt() > $maxDate ){ 
                $maxDate = $e->getcreatedAt() ;
            }
        }
        
        /*
        */
        $dompdf = new Dompdf();
        
        $html = $this->renderView('produit/edit/_etatDesLieuxPdf.html.twig', [
            'produit'=>$produit,
            'minDate'=>$minDate,
            'maxDate' => $maxDate,
            'EtatsTab'=>$EtatsTab,
            'statutEtats'=>$statutEtatDesLieuxRepository->findAll(),
            'missionTab'=>$missionTab,
            'observations' => $observations,
        ]);
        
        $dompdf->loadHtml($html) ;
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $dompdf->render();
        ob_get_clean();
        // Output the generated PDF to Browser
        $dompdf->stream('Etat des lieux produit '.$produit->getName() , ['Attachment' => false ] );
        
        return $this->renderForm('produit/edit/_etatDesLieuxPdf.html.twig', [
            'produit'=>$produit,
            'EtatsTab'=>$EtatsTab,
            'minDate'=>$minDate,
            'statutEtats'=>$statutEtatDesLieuxRepository->findAll(),
            'missionTab'=>$missionTab,
            'observations' => $observations,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
