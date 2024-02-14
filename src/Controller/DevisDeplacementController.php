<?php

namespace App\Controller;

use App\Entity\DevisDeplacement;
use App\Form\DevisDeplacementType;
use App\Repository\DevisDeplacementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/devis/deplacement')]
class DevisDeplacementController extends AbstractController
{
    #[Route('/', name: 'app_devis_deplacement_index', methods: ['GET'])]
    public function index(DevisDeplacementRepository $devisDeplacementRepository): Response
    {
        return $this->render('devis_deplacement/index.html.twig', [
            'devis_deplacements' => $devisDeplacementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_devis_deplacement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DevisDeplacementRepository $devisDeplacementRepository): Response
    {
        $devisDeplacement = new DevisDeplacement();
        $form = $this->createForm(DevisDeplacementType::class, $devisDeplacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisDeplacementRepository->save($devisDeplacement, true);

            return $this->redirectToRoute('app_devis_deplacement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_deplacement/new.html.twig', [
            'devis_deplacement' => $devisDeplacement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_deplacement_show', methods: ['GET'])]
    public function show(DevisDeplacement $devisDeplacement): Response
    {
        return $this->render('devis_deplacement/show.html.twig', [
            'devis_deplacement' => $devisDeplacement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_devis_deplacement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DevisDeplacement $devisDeplacement, DevisDeplacementRepository $devisDeplacementRepository): Response
    {
        $form = $this->createForm(DevisDeplacementType::class, $devisDeplacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $devisDeplacementRepository->save($devisDeplacement, true);

            return $this->redirectToRoute('app_devis_edit', ['id' => $devisDeplacement->getDevis()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('devis_deplacement/edit.html.twig', [
            'devis_deplacement' => $devisDeplacement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_devis_deplacement_delete', methods: ['POST'])]
    public function delete(Request $request, DevisDeplacement $devisDeplacement, DevisDeplacementRepository $devisDeplacementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$devisDeplacement->getId(), $request->request->get('_token'))) {
            $devisDeplacementRepository->remove($devisDeplacement, true);
        }

        return $this->redirectToRoute('app_devis_edit', ['id' => $devisDeplacement->getDevis()->getId()], Response::HTTP_SEE_OTHER);
    }
}
