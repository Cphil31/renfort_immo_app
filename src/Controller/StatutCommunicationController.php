<?php

namespace App\Controller;

use App\Entity\StatutCommunication;
use App\Form\StatutCommunicationType;
use App\Repository\StatutCommunicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/communication')]
class StatutCommunicationController extends AbstractController
{
    #[Route('/', name: 'app_statut_communication_index', methods: ['GET'])]
    public function index(StatutCommunicationRepository $statutCommunicationRepository): Response
    {
        return $this->render('statut_communication/index.html.twig', [
            'statut_communications' => $statutCommunicationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_communication_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutCommunicationRepository $statutCommunicationRepository): Response
    {
        $statutCommunication = new StatutCommunication();
        $form = $this->createForm(StatutCommunicationType::class, $statutCommunication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutCommunicationRepository->save($statutCommunication, true);

            return $this->redirectToRoute('app_statut_communication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_communication/new.html.twig', [
            'statut_communication' => $statutCommunication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_communication_show', methods: ['GET'])]
    public function show(StatutCommunication $statutCommunication): Response
    {
        return $this->render('statut_communication/show.html.twig', [
            'statut_communication' => $statutCommunication,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_communication_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutCommunication $statutCommunication, StatutCommunicationRepository $statutCommunicationRepository): Response
    {
        $form = $this->createForm(StatutCommunicationType::class, $statutCommunication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutCommunicationRepository->save($statutCommunication, true);

            return $this->redirectToRoute('app_statut_communication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_communication/edit.html.twig', [
            'statut_communication' => $statutCommunication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_communication_delete', methods: ['POST'])]
    public function delete(Request $request, StatutCommunication $statutCommunication, StatutCommunicationRepository $statutCommunicationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutCommunication->getId(), $request->request->get('_token'))) {
            $statutCommunicationRepository->remove($statutCommunication, true);
        }

        return $this->redirectToRoute('app_statut_communication_index', [], Response::HTTP_SEE_OTHER);
    }
}
