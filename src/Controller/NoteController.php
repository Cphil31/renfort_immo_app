<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/note')]
class NoteController extends AbstractController
{
    #[Route('/', name: 'app_note_index', methods: ['GET'])]
    public function index(NoteRepository $noteRepository): Response
    {
        return $this->render('note/index.html.twig', [
            'notes' => $noteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_note_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NoteRepository $noteRepository): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $noteRepository->save($note, true);

            return $this->redirectToRoute('app_note_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('note/new.html.twig', [
            'note' => $note,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_note_show', methods: ['GET'])]
    public function show(Note $note): Response
    {
        return $this->render('note/show.html.twig', [
            'note' => $note,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_note_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Note $note, NoteRepository $noteRepository): Response
    {

        $formEdit = $this->createFormBuilder($note)
        ->add('note')
        ->getForm();
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {
            $noteRepository->save($note, true);

            if( $note->getContact() == null)
            {
                return $this->redirectToRoute('app_entreprise_edit', ['id' => $note->getEntreprise()->getId()], Response::HTTP_SEE_OTHER);
            }
            if( $note->getEntreprise() == null)
            {
                return $this->redirectToRoute('app_contact_edit', ['id' => $note->getContact()->getId()], Response::HTTP_SEE_OTHER);
            }

        }

        return $this->renderForm('note/edit.html.twig', [
            'note' => $note,
            'form' => $formEdit,
        ]);
    }

    #[Route('/{id}', name: 'app_note_delete', methods: ['POST'])]
    public function delete(Request $request, Note $note, NoteRepository $noteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getId(), $request->request->get('_token'))) {
            $noteRepository->remove($note, true);
        }

        if( $note->getContact() )
        {
            return $this->redirectToRoute('app_contact_edit', ['id' => $note->getContact()->getId()], Response::HTTP_SEE_OTHER);
        }
        if( $note->getEntreprise() )
        {
            return $this->redirectToRoute('app_entreprise_edit', ['id' => $note->getEntreprise()->getId()], Response::HTTP_SEE_OTHER);
        }


    }
}
