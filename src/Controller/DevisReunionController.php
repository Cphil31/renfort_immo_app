<?php

namespace App\Controller;

use App\Entity\DevisReunion;
use App\Form\DevisReunionType;
use App\Repository\DevisReunionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/devis/reunion')]
class DevisReunionController extends AbstractController
{
    #[Route('/', name: 'app_devis_reunion_index', methods: ['GET'])]
    public function index(DevisReunionRepository $devisReunionRepository): Response
    {
        return $this->render('devis_reunion/index.html.twig', [
            'devis_reunions' => $devisReunionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_devis_reunion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DevisReunionRepository $devisReunionRepository): Response
    {
        $devisReunion = new DevisReunion();
        $form = $this->createForm(DevisReunionType::class, $devisReunion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisReunionRepository->save($devisReunion, true);

            return $this->redirectToRoute('app_devis_reunion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_reunion/new.html.twig', [
            'devis_reunion' => $devisReunion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_reunion_show', methods: ['GET'])]
    public function show(DevisReunion $devisReunion): Response
    {
        return $this->render('devis_reunion/show.html.twig', [
            'devis_reunion' => $devisReunion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devis_reunion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DevisReunion $devisReunion, DevisReunionRepository $devisReunionRepository): Response
    {
        $form = $this->createForm(DevisReunionType::class, $devisReunion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisReunionRepository->save($devisReunion, true);

            return $this->redirectToRoute('app_devis_edit', ['id' => $devisReunion->getDevis()->getId() ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_reunion/edit.html.twig', [
            'devis_reunion' => $devisReunion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_reunion_delete', methods: ['POST'])]
    public function delete(Request $request, DevisReunion $devisReunion, DevisReunionRepository $devisReunionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devisReunion->getId(), $request->request->get('_token'))) {
            $devisReunionRepository->remove($devisReunion, true);
        }

        return $this->redirectToRoute('app_devis_edit', ['id' => $devisReunion->getDevis()->getId() ], Response::HTTP_SEE_OTHER);
    }
}
