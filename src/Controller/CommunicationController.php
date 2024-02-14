<?php

namespace App\Controller;

use App\Entity\Communication;
use App\Form\CommunicationTacheType;
use App\Form\CommunicationType;
use App\Form\EditComTacheType;
use App\Repository\CommunicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/communication')]
class CommunicationController extends AbstractController
{
    #[Route('/', name: 'app_communication_index', methods: ['GET'])]
    public function index(CommunicationRepository $communicationRepository): Response
    {
        return $this->render('communication/index.html.twig', [
            'communications' => $communicationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_communication_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommunicationRepository $communicationRepository): Response
    {
        $communication = new Communication();
        $form = $this->createForm(CommunicationType::class, $communication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $communicationRepository->save($communication, true);

            return $this->redirectToRoute('app_communication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('communication/new.html.twig', [
            'communication' => $communication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_communication_show', methods: ['GET'])]
    public function show(Communication $communication): Response
    {
        return $this->render('communication/show.html.twig', [
            'communication' => $communication,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_communication_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Communication $communication, CommunicationRepository $communicationRepository): Response
    {
        $form = $this->createForm(CommunicationTacheType::class, $communication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $communication->setTache($communication->getTache());
            $communicationRepository->save($communication, true);

            return $this->redirectToRoute('app_tache_edit', ['id' => $communication->getTache()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('communication/edit.html.twig', [
            'communication' => $communication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_communication_delete', methods: ['POST'])]
    public function delete(Request $request, Communication $communication, CommunicationRepository $communicationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$communication->getId(), $request->request->get('_token'))) {
            $communicationRepository->remove($communication, true);
        }

        return $this->redirectToRoute('app_tache_edit', ['id' => $communication->getTache()->getId()], Response::HTTP_SEE_OTHER);
    }
}
