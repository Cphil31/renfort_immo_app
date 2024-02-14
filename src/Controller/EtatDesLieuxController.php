<?php

namespace App\Controller;

use App\Entity\EtatDesLieux;
use App\Form\EtatDesLieuxType;
use App\Form\EditEtatDesLieuxType;
use App\Form\NewEtatDesLieuxTypesType;
use App\Repository\EtatDesLieuxRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/etat/des/lieux')]
class EtatDesLieuxController extends AbstractController
{
    #[Route('/', name: 'app_etat_des_lieux_index', methods: ['GET'])]
    public function index(EtatDesLieuxRepository $etatDesLieuxRepository): Response
    {
        return $this->render('etat_des_lieux/index.html.twig', [
            'etat_des_lieuxes' => $etatDesLieuxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etat_des_lieux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EtatDesLieuxRepository $etatDesLieuxRepository): Response
    {
        $etatDesLieux = new EtatDesLieux();
        $form = $this->createForm(EtatDesLieuxType::class, $etatDesLieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatDesLieux->setProduit($etatDesLieux->getProduit());
            $etatDesLieuxRepository->save($etatDesLieux, true);

            return $this->redirectToRoute('app_etat_des_lieux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etat_des_lieux/new.html.twig', [
            'etat_des_lieux' => $etatDesLieux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etat_des_lieux_show', methods: ['GET'])]
    public function show(EtatDesLieux $etatDesLieux): Response
    {
        return $this->render('etat_des_lieux/show.html.twig', [
            'etat_des_lieux' => $etatDesLieux,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etat_des_lieux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EtatDesLieux $etatDesLieux, EtatDesLieuxRepository $etatDesLieuxRepository): Response
    {
        $form = $this->createForm(NewEtatDesLieuxTypesType::class, $etatDesLieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatDesLieuxRepository->save($etatDesLieux, true);

            return $this->redirectToRoute('app_produit_edit', [ 'id' => $etatDesLieux->getProduit()->getId() ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etat_des_lieux/edit.html.twig', [
            'etat_des_lieux' => $etatDesLieux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etat_des_lieux_delete', methods: ['POST'])]
    public function delete(Request $request, EtatDesLieux $etatDesLieux, EtatDesLieuxRepository $etatDesLieuxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etatDesLieux->getId(), $request->request->get('_token'))) {
            $etatDesLieuxRepository->remove($etatDesLieux, true);
        }

        return $this->redirectToRoute('app_produit_edit', [ 'id' => $etatDesLieux->getProduit()->getId() ], Response::HTTP_SEE_OTHER);
    }
}
