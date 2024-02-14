<?php

namespace App\Controller;

use App\Entity\StatutDeplacement;
use App\Form\StatutDeplacementType;
use App\Repository\StatutDeplacementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/deplacement')]
class StatutDeplacementController extends AbstractController
{
    #[Route('/', name: 'app_statut_deplacement_index', methods: ['GET'])]
    public function index(StatutDeplacementRepository $statutDeplacementRepository): Response
    {
        return $this->render('statut_deplacement/index.html.twig', [
            'statut_deplacements' => $statutDeplacementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_deplacement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutDeplacementRepository $statutDeplacementRepository): Response
    {
        $statutDeplacement = new StatutDeplacement();
        $form = $this->createForm(StatutDeplacementType::class, $statutDeplacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutDeplacementRepository->save($statutDeplacement, true);

            return $this->redirectToRoute('app_statut_deplacement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_deplacement/new.html.twig', [
            'statut_deplacement' => $statutDeplacement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_deplacement_show', methods: ['GET'])]
    public function show(StatutDeplacement $statutDeplacement): Response
    {
        return $this->render('statut_deplacement/show.html.twig', [
            'statut_deplacement' => $statutDeplacement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_deplacement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutDeplacement $statutDeplacement, StatutDeplacementRepository $statutDeplacementRepository): Response
    {
        $form = $this->createForm(StatutDeplacementType::class, $statutDeplacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutDeplacementRepository->save($statutDeplacement, true);

            return $this->redirectToRoute('app_statut_deplacement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_deplacement/edit.html.twig', [
            'statut_deplacement' => $statutDeplacement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_deplacement_delete', methods: ['POST'])]
    public function delete(Request $request, StatutDeplacement $statutDeplacement, StatutDeplacementRepository $statutDeplacementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutDeplacement->getId(), $request->request->get('_token'))) {
            $statutDeplacementRepository->remove($statutDeplacement, true);
        }

        return $this->redirectToRoute('app_statut_deplacement_index', [], Response::HTTP_SEE_OTHER);
    }
}
