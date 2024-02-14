<?php

namespace App\Controller;

use App\Entity\StatutEtatDesLieux;
use App\Form\StatutEtatDesLieuxType;
use App\Repository\StatutEtatDesLieuxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/etat/des/lieux')]
class StatutEtatDesLieuxController extends AbstractController
{
    #[Route('/', name: 'app_statut_etat_des_lieux_index', methods: ['GET'])]
    public function index(StatutEtatDesLieuxRepository $statutEtatDesLieuxRepository): Response
    {
        return $this->render('statut_etat_des_lieux/index.html.twig', [
            'statut_etat_des_lieuxes' => $statutEtatDesLieuxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_etat_des_lieux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutEtatDesLieuxRepository $statutEtatDesLieuxRepository): Response
    {
        $statutEtatDesLieux = new StatutEtatDesLieux();
        $form = $this->createForm(StatutEtatDesLieuxType::class, $statutEtatDesLieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutEtatDesLieuxRepository->save($statutEtatDesLieux, true);

            return $this->redirectToRoute('app_statut_etat_des_lieux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_etat_des_lieux/new.html.twig', [
            'statut_etat_des_lieux' => $statutEtatDesLieux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_etat_des_lieux_show', methods: ['GET'])]
    public function show(StatutEtatDesLieux $statutEtatDesLieux): Response
    {
        return $this->render('statut_etat_des_lieux/show.html.twig', [
            'statut_etat_des_lieux' => $statutEtatDesLieux,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_etat_des_lieux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutEtatDesLieux $statutEtatDesLieux, StatutEtatDesLieuxRepository $statutEtatDesLieuxRepository): Response
    {
        $form = $this->createForm(StatutEtatDesLieuxType::class, $statutEtatDesLieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutEtatDesLieuxRepository->save($statutEtatDesLieux, true);

            return $this->redirectToRoute('app_statut_etat_des_lieux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_etat_des_lieux/edit.html.twig', [
            'statut_etat_des_lieux' => $statutEtatDesLieux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_etat_des_lieux_delete', methods: ['POST'])]
    public function delete(Request $request, StatutEtatDesLieux $statutEtatDesLieux, StatutEtatDesLieuxRepository $statutEtatDesLieuxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutEtatDesLieux->getId(), $request->request->get('_token'))) {
            $statutEtatDesLieuxRepository->remove($statutEtatDesLieux, true);
        }

        return $this->redirectToRoute('app_statut_etat_des_lieux_index', [], Response::HTTP_SEE_OTHER);
    }
}
