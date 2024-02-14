<?php

namespace App\Controller;

use App\Entity\DevisRestauration;
use App\Form\DevisRestaurationType;
use App\Repository\DevisRestaurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/devis/restauration')]
class DevisRestaurationController extends AbstractController
{
    #[Route('/', name: 'app_devis_restauration_index', methods: ['GET'])]
    public function index(DevisRestaurationRepository $devisRestaurationRepository): Response
    {
        return $this->render('devis_restauration/index.html.twig', [
            'devis_restaurations' => $devisRestaurationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_devis_restauration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DevisRestaurationRepository $devisRestaurationRepository): Response
    {
        $devisRestauration = new DevisRestauration();
        $form = $this->createForm(DevisRestaurationType::class, $devisRestauration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisRestaurationRepository->save($devisRestauration, true);

            return $this->redirectToRoute('app_devis_restauration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_restauration/new.html.twig', [
            'devis_restauration' => $devisRestauration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_restauration_show', methods: ['GET'])]
    public function show(DevisRestauration $devisRestauration): Response
    {
        return $this->render('devis_restauration/show.html.twig', [
            'devis_restauration' => $devisRestauration,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devis_restauration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DevisRestauration $devisRestauration, DevisRestaurationRepository $devisRestaurationRepository): Response
    {
        $form = $this->createForm(DevisRestaurationType::class, $devisRestauration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisRestaurationRepository->save($devisRestauration, true);

            return $this->redirectToRoute('app_devis_edit', ['id' => $devisRestauration->getDevis()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_restauration/edit.html.twig', [
            'devis_restauration' => $devisRestauration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_restauration_delete', methods: ['POST'])]
    public function delete(Request $request, DevisRestauration $devisRestauration, DevisRestaurationRepository $devisRestaurationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devisRestauration->getId(), $request->request->get('_token'))) {
            $devisRestaurationRepository->remove($devisRestauration, true);
        }

        return $this->redirectToRoute('app_devis_edit', ['id' => $devisRestauration->getDevis()->getId()], Response::HTTP_SEE_OTHER);
    }
}
