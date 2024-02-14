<?php

namespace App\Controller;

use App\Entity\StatutContact;
use App\Form\StatutContactType;
use App\Repository\StatutContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/contact')]
class StatutContactController extends AbstractController
{
    #[Route('/', name: 'app_statut_contact_index', methods: ['GET'])]
    public function index(StatutContactRepository $statutContactRepository): Response
    {
        return $this->render('statut_contact/index.html.twig', [
            'statut_contacts' => $statutContactRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_contact_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutContactRepository $statutContactRepository): Response
    {
        $statutContact = new StatutContact();
        $form = $this->createForm(StatutContactType::class, $statutContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutContactRepository->save($statutContact, true);

            return $this->redirectToRoute('app_statut_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_contact/new.html.twig', [
            'statut_contact' => $statutContact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_contact_show', methods: ['GET'])]
    public function show(StatutContact $statutContact): Response
    {
        return $this->render('statut_contact/show.html.twig', [
            'statut_contact' => $statutContact,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_contact_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutContact $statutContact, StatutContactRepository $statutContactRepository): Response
    {
        $form = $this->createForm(StatutContactType::class, $statutContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutContactRepository->save($statutContact, true);

            return $this->redirectToRoute('app_statut_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_contact/edit.html.twig', [
            'statut_contact' => $statutContact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_contact_delete', methods: ['POST'])]
    public function delete(Request $request, StatutContact $statutContact, StatutContactRepository $statutContactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutContact->getId(), $request->request->get('_token'))) {
            $statutContactRepository->remove($statutContact, true);
        }

        return $this->redirectToRoute('app_statut_contact_index', [], Response::HTTP_SEE_OTHER);
    }
}
