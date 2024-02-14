<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Form\Document1Type;
use App\Form\NewDocumentTacheType;
use App\Repository\DocumentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/document')]
class DocumentController extends AbstractController
{
    #[Route('/', name: 'app_document_index', methods: ['GET'])]
    public function index(DocumentRepository $documentRepository): Response
    {
        return $this->render('document/index.html.twig', [
            'documents' => $documentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_document_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DocumentRepository $documentRepository): Response
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentRepository->save($document, true);

            return $this->redirectToRoute('app_document_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('document/new.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'app_document_show', methods: ['GET'])]
    public function show(Document $document): Response
    {
        return $this->render('document/show.html.twig', [
            'document' => $document,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_document_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Document $document, DocumentRepository $documentRepository,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(NewDocumentTacheType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nom=$document->getName();
            
            $document->setTache($document->getTache());

        
                unlink($this->getParameter('document_directory').'/'.$nom);
            
            
            
                 /** @var UploadedFile $brochureFile */
                 $brochureFile = $form->get('name')->getData();
                 


                 // this condition is needed because the 'brochure' field is not required
                 // so the PDF file must be processed only when a file is uploaded
                 if ($brochureFile) {
                     $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                     // this is needed to safely include the file name as part of the URL
                     $safeFilename = $slugger->slug($originalFilename);
                     $newFilename = $safeFilename.'-'.$document->getTache()->getDescription().'-'.uniqid().'.'.$brochureFile->guessExtension();
     
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
            $documentRepository->save($document, true);

            return $this->redirectToRoute('app_tache_edit', ['id' => $document->getTache()->getId()], Response::HTTP_SEE_OTHER);
        }
       

        return $this->renderForm('document/edit.html.twig', [
            'document' => $document,
            'form' => $form, 
        ]);
    }

    #[Route('/{id}', name: 'app_document_delete', methods: ['POST'])]
    public function delete(Request $request, Document $document, DocumentRepository $documentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $nom=$document->getName();
            unlink($this->getParameter('document_directory').'/'.$nom);
            $documentRepository->remove($document, true);
        }

        return $this->redirectToRoute('app_tache_edit', ['id' => $document->getTache()->getId()], Response::HTTP_SEE_OTHER);
    }
}
