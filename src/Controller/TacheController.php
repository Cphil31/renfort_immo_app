<?php

namespace App\Controller;


use App\Entity\Tache;
use DateTimeImmutable;
use App\Entity\Forfait;
use App\Entity\Reunion;
use App\Form\TacheType;
use App\Entity\Document;
use App\Entity\Deplacement;
use App\Entity\Hebergement;
use App\Entity\Intervenant;
use App\Form\EditTacheType;
use App\Entity\Restauration;
use App\Entity\Communication;
use App\Form\CommunicationTacheType;
use App\Form\EditForfaitType;
use App\Form\ReunionTacheType;
use App\Form\DeplacementTacheType;
use App\Form\DeplacementType;
use App\Form\HebergementTacheType;
use App\Form\NewDocumentTacheType;
use App\Form\RestaurationTacheType;
use App\Repository\TacheRepository;
use App\Form\NewIntervenantTacheType;
use App\Repository\ForfaitRepository;
use App\Repository\ReunionRepository;
use App\Repository\DocumentRepository;
use App\Repository\DeplacementRepository;
use App\Repository\HebergementRepository;
use App\Repository\IntervenantRepository;
use App\Repository\RestaurationRepository;
use App\Repository\CommunicationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


#[Route('/tache')]
class TacheController extends AbstractController
{
    #[Route('/', name: 'app_tache_index', methods: ['GET'])]
    public function index(TacheRepository $tacheRepository): Response
    {
        return $this->render('tache/index.html.twig', [
            'taches' => $tacheRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tache_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TacheRepository $tacheRepository): Response
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tacheRepository->save($tache, true);

            return $this->redirectToRoute('app_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tache/new.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tache_show', methods: ['GET'])]
    public function show(Tache $tache): Response
    {
        return $this->render('tache/show.html.twig', [
            'tache' => $tache,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tache_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tache $tache, TacheRepository $tacheRepository,CommunicationRepository $communicationRepository,IntervenantRepository $intervenantRepository,DeplacementRepository $deplacementRepository,DocumentRepository $documentRepository,ForfaitRepository $forfaitRepository,SluggerInterface $slugger,HebergementRepository $hebergementRepository,RestaurationRepository $restaurationRepository,ReunionRepository $reunionRepository): Response
    {
        $today = new DateTimeImmutable('now');
        $form = $this->createForm(EditTacheType::class, $tache);
        $form->handleRequest($request);

        // ajouter communication
        $com = new Communication();
        $com->setTache($tache);
        $formNewCom = $this->createForm(CommunicationTacheType::class,$com);
        $formNewCom->handleRequest($request); 
        if ($formNewCom->isSubmitted() && $formNewCom->isValid()) {
            $communicationRepository->save($com, true);

            return $this->redirectToRoute('app_tache_edit', ['id' => $tache->getId()], Response::HTTP_SEE_OTHER);
        }
        // ajouter communication

        // ajouter un intervenant 
        $intervenant = new Intervenant();
        $formNewInt = $this->createForm(NewIntervenantTacheType::class , $intervenant); 
        $formNewInt->handleRequest($request);
        $intervenant->setTache($tache);
        //dd($intervenant);

        if ($formNewInt->isSubmitted() && $formNewInt->isValid()) {
            $intervenantRepository->save($intervenant, true);

            return $this->redirectToRoute('app_tache_edit', ['id' => $tache->getId()], Response::HTTP_SEE_OTHER);
        }
        
        // ajouter un intervenant

        // ajouter un déplacement 
        $deplacement = new Deplacement();

        $formNewDep = $this->createForm(DeplacementType::class,$deplacement);   

        $formNewDep->handleRequest($request);
         
        if ($formNewDep->isSubmitted() && $formNewDep->isValid()) {
            
            $deplacement->setTache($tache);
            $deplacement->setDate($today);
            //dd($deplacement);
            $deplacementRepository->save($deplacement, true);

            return $this->redirectToRoute('app_tache_edit', [ 'id' => $tache->getId() ], Response::HTTP_SEE_OTHER);
        }



        // ajouter un déplacement 


        // ajouter un document 
        $document = new Document();
        $formDocument = $this->createForm(NewDocumentTacheType::class, $document);
        $formDocument->handleRequest($request);
        if ($formDocument->isSubmitted() && $formDocument->isValid()) {
            $document->setTache($tache);
                 /** @var UploadedFile $brochureFile */
                 $brochureFile = $formDocument->get('name')->getData();

                 // this condition is needed because the 'brochure' field is not required
                 // so the PDF file must be processed only when a file is uploaded
                 if ($brochureFile) {
                     $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                     // this is needed to safely include the file name as part of the URL
                     $safeFilename = $slugger->slug($originalFilename);
                     $newFilename = $safeFilename.'-'.$tache->getDescription().'-'.uniqid().'.'.$brochureFile->guessExtension();
     
                     // Move the file to the directory where brochures are stored
                     try {
                         $brochureFile->move(
                             $this->getParameter('document_directory'),
                             $newFilename
                         );
                     } catch (FileException $e) {
                         // ... handle exception if something happens during file upload
                     }
     
                     // updates the 'brochureFilename' property to store the PDF file name
                     // instead of its contents
                     $document->setName($newFilename);
                     $documentRepository->save($document, true);
                 }
                 
                 
                 
                 // ... persist the $product variable or any other work
                 
                 return $this->redirectToRoute('app_tache_edit', [ 'id' => $tache->getId() ], Response::HTTP_SEE_OTHER);
                 
                 
                }

                
        // ajouter un document



        // ajouter un forfait
        $for = new Forfait();
        $formFor = $this->createForm(EditForfaitType::class, $for);
        $formFor->handleRequest($request);
        
        
        if ($formFor->isSubmitted() && $formFor->isValid()) {
            $for->setTache($tache);
            $forfaitRepository->save($for, true);

            return $this->redirectToRoute('app_tache_edit', ['id' => $tache->getiD() ], Response::HTTP_SEE_OTHER);
        }

        // ajouter un forfait

        // ajouter un hébergement 
        $heb = new Hebergement();
        $formHeb = $this->createForm(HebergementTacheType::class,$heb);
        $formHeb->handleRequest($request);

        if ($formHeb->isSubmitted() && $formHeb->isValid()) {
            $heb->setTache($tache);
            $hebergementRepository->save($heb, true);

            return $this->redirectToRoute('app_tache_edit', ['id' => $tache->getiD() ], Response::HTTP_SEE_OTHER);
        }


        // ajouter un hébergement


        // ajouter une restauration
        $restauration = new Restauration();
        $formRestau = $this->createForm(RestaurationTacheType::class,$restauration);
        $formRestau->handleRequest($request);
        
        if ($formRestau->isSubmitted() && $formRestau->isValid()) {
            $restauration->setTache($tache);
            $restaurationRepository->save($restauration, true);
            
            return $this->redirectToRoute('app_tache_edit', ['id' => $tache->getiD() ], Response::HTTP_SEE_OTHER);
        }
        
        // ajouter une restauration


        // ajouter une réunion
        $reunion = new Reunion();
        $formReunion = $this->createForm(ReunionTacheType::class,$reunion);
        $formReunion->handleRequest($request);
        
        if ($formReunion->isSubmitted() && $formReunion->isValid()) {
            $reunion->setTache($tache);
            $reunionRepository->save($reunion, true);
            return $this->redirectToRoute('app_tache_edit', ['id' => $tache->getiD() ], Response::HTTP_SEE_OTHER);
        }
        


        // ajouter une réunion



        // formulaire edit tache
        if ($form->isSubmitted() && $form->isValid()) {
            $tache->setProbleme($tache->getProbleme());
            $tacheRepository->save($tache, true);

            return $this->redirectToRoute('app_tache_edit', ['id' => $tache->getId()], Response::HTTP_SEE_OTHER);
        }
        // formulaire edit tache

        return $this->renderForm('tache/edit.html.twig', [
            'tache' => $tache,
            'form' => $form,
            'formNewCom' => $formNewCom,
            'formNewDep' => $formNewDep,
            'formFor' => $formFor,
            'formIntervenant' => $formNewInt,
            'formDoc' => $formDocument,
            'formHeb'=> $formHeb,
            'formRestau'=>$formRestau,
            'formReunion' =>$formReunion
        ]);
    }

    

    #[Route('/{id}', name: 'app_tache_delete', methods: ['POST'])]
    public function delete(Request $request, Tache $tache, TacheRepository $tacheRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tache->getId(), $request->request->get('_token'))) {
            $tacheRepository->remove($tache, true);
        }

        return $this->redirectToRoute('app_probleme_edit', ['id' => $tache->getProbleme()->getId()], Response::HTTP_SEE_OTHER);
    }
}