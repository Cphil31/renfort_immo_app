<?php

namespace App\Controller;

use App\Entity\DevisHebergement;
use App\Form\DevisHebergementType;
use App\Repository\DevisHebergementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/devis/hebergement')]
class DevisHebergementController extends AbstractController
{
    #[Route('/', name: 'app_devis_hebergement_index', methods: ['GET'])]
    public function index(DevisHebergementRepository $devisHebergementRepository): Response
    {
        return $this->render('devis_hebergement/index.html.twig', [
            'devis_hebergements' => $devisHebergementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_devis_hebergement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DevisHebergementRepository $devisHebergementRepository): Response
    {
        $devisHebergement = new DevisHebergement();
        $form = $this->createForm(DevisHebergementType::class, $devisHebergement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisHebergementRepository->save($devisHebergement, true);

            return $this->redirectToRoute('app_devis_hebergement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_hebergement/new.html.twig', [
            'devis_hebergement' => $devisHebergement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_hebergement_show', methods: ['GET'])]
    public function show(DevisHebergement $devisHebergement): Response
    {
        return $this->render('devis_hebergement/show.html.twig', [
            'devis_hebergement' => $devisHebergement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devis_hebergement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DevisHebergement $devisHebergement, DevisHebergementRepository $devisHebergementRepository): Response
    {
        $form = $this->createForm(DevisHebergementType::class, $devisHebergement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisHebergementRepository->save($devisHebergement, true);

            return $this->redirectToRoute('app_devis_edit', ['id' => $devisHebergement->getDevis()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_hebergement/edit.html.twig', [
            'devis_hebergement' => $devisHebergement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_hebergement_delete', methods: ['POST'])]
    public function delete(Request $request, DevisHebergement $devisHebergement, DevisHebergementRepository $devisHebergementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devisHebergement->getId(), $request->request->get('_token'))) {
            $devisHebergementRepository->remove($devisHebergement, true);
        }

        return $this->redirectToRoute('app_devis_edit', ['id' => $devisHebergement->getDevis()->getId()], Response::HTTP_SEE_OTHER);
    }
}
