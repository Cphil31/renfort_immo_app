<?php

namespace App\Controller;

use App\Entity\StatutEntreprise;
use App\Form\StatutEntrepriseType;
use App\Repository\StatutEntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/entreprise')]
class StatutEntrepriseController extends AbstractController
{
    #[Route('/', name: 'app_statut_entreprise_index', methods: ['GET'])]
    public function index(StatutEntrepriseRepository $statutEntrepriseRepository): Response
    {
        return $this->render('statut_entreprise/index.html.twig', [
            'statut_entreprises' => $statutEntrepriseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_entreprise_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutEntrepriseRepository $statutEntrepriseRepository): Response
    {
        $statutEntreprise = new StatutEntreprise();
        $form = $this->createForm(StatutEntrepriseType::class, $statutEntreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutEntrepriseRepository->save($statutEntreprise, true);

            return $this->redirectToRoute('app_statut_entreprise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_entreprise/new.html.twig', [
            'statut_entreprise' => $statutEntreprise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_entreprise_show', methods: ['GET'])]
    public function show(StatutEntreprise $statutEntreprise): Response
    {
        return $this->render('statut_entreprise/show.html.twig', [
            'statut_entreprise' => $statutEntreprise,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_entreprise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutEntreprise $statutEntreprise, StatutEntrepriseRepository $statutEntrepriseRepository): Response
    {
        $form = $this->createForm(StatutEntrepriseType::class, $statutEntreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutEntrepriseRepository->save($statutEntreprise, true);

            return $this->redirectToRoute('app_statut_entreprise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_entreprise/edit.html.twig', [
            'statut_entreprise' => $statutEntreprise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_entreprise_delete', methods: ['POST'])]
    public function delete(Request $request, StatutEntreprise $statutEntreprise, StatutEntrepriseRepository $statutEntrepriseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutEntreprise->getId(), $request->request->get('_token'))) {
            $statutEntrepriseRepository->remove($statutEntreprise, true);
        }

        return $this->redirectToRoute('app_statut_entreprise_index', [], Response::HTTP_SEE_OTHER);
    }
}
