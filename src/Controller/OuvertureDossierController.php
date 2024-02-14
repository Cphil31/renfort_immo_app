<?php

namespace App\Controller;

use App\Entity\OuvertureDossier;
use App\Form\OuvertureDossierType;
use App\Repository\OuvertureDossierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ouverture/dossier')]
class OuvertureDossierController extends AbstractController
{
    #[Route('/', name: 'app_ouverture_dossier_index', methods: ['GET'])]
    public function index(OuvertureDossierRepository $ouvertureDossierRepository): Response
    {
        return $this->render('ouverture_dossier/index.html.twig', [
            'ouverture_dossiers' => $ouvertureDossierRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ouverture_dossier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OuvertureDossierRepository $ouvertureDossierRepository): Response
    {
        $ouvertureDossier = new OuvertureDossier();
        $form = $this->createForm(OuvertureDossierType::class, $ouvertureDossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ouvertureDossierRepository->save($ouvertureDossier, true);

            return $this->redirectToRoute('app_ouverture_dossier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ouverture_dossier/new.html.twig', [
            'ouverture_dossier' => $ouvertureDossier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ouverture_dossier_show', methods: ['GET'])]
    public function show(OuvertureDossier $ouvertureDossier): Response
    {
        return $this->render('ouverture_dossier/show.html.twig', [
            'ouverture_dossier' => $ouvertureDossier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ouverture_dossier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OuvertureDossier $ouvertureDossier, OuvertureDossierRepository $ouvertureDossierRepository): Response
    {
        
        $form = $this->createForm(OuvertureDossierType::class, $ouvertureDossier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ouvertureDossierRepository->save($ouvertureDossier, true);

            return $this->redirectToRoute('app_devis_edit', ['id' => $ouvertureDossier->getDevis()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ouverture_dossier/edit.html.twig', [
            'ouverture_dossier' => $ouvertureDossier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ouverture_dossier_delete', methods: ['POST'])]
    public function delete(Request $request, OuvertureDossier $ouvertureDossier, OuvertureDossierRepository $ouvertureDossierRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ouvertureDossier->getId(), $request->request->get('_token'))) {
            $ouvertureDossierRepository->remove($ouvertureDossier, true);
        }

        return $this->redirectToRoute('app_devis_edit', ['id' => $ouvertureDossier->getDevis()->getId()], Response::HTTP_SEE_OTHER);
    }
}
