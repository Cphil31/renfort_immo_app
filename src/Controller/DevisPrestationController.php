<?php

namespace App\Controller;

use App\Entity\DevisPrestation;
use App\Form\DevisPrestationType;
use App\Repository\DevisPrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/devis/prestation')]
class DevisPrestationController extends AbstractController
{
    #[Route('/', name: 'app_devis_prestation_index', methods: ['GET'])]
    public function index(DevisPrestationRepository $devisPrestationRepository): Response
    {
        return $this->render('devis_prestation/index.html.twig', [
            'devis_prestations' => $devisPrestationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_devis_prestation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DevisPrestationRepository $devisPrestationRepository): Response
    {
        $devisPrestation = new DevisPrestation();
        $form = $this->createForm(DevisPrestationType::class, $devisPrestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $devisPrestationRepository->save($devisPrestation, true);

            return $this->redirectToRoute('app_devis_prestation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_prestation/new.html.twig', [
            'devis_prestation' => $devisPrestation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_prestation_show', methods: ['GET'])]
    public function show(DevisPrestation $devisPrestation): Response
    {
        return $this->render('devis_prestation/show.html.twig', [
            'devis_prestation' => $devisPrestation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devis_prestation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DevisPrestation $devisPrestation, DevisPrestationRepository $devisPrestationRepository): Response
    {
        $form = $this->createForm(DevisPrestationType::class, $devisPrestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisPrestationRepository->save($devisPrestation, true);

            return $this->redirectToRoute('app_devis_edit', ['id' => $devisPrestation->getDevis()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_prestation/edit.html.twig', [
            'devis_prestation' => $devisPrestation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_prestation_delete', methods: ['POST'])]
    public function delete(Request $request, DevisPrestation $devisPrestation, DevisPrestationRepository $devisPrestationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devisPrestation->getId(), $request->request->get('_token'))) {
            $devisPrestationRepository->remove($devisPrestation, true);
        }

        return $this->redirectToRoute('app_devis_edit', ['id' => $devisPrestation->getDevis()->getId()], Response::HTTP_SEE_OTHER);
    }
}
