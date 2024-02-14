<?php

namespace App\Controller;

use App\Entity\StatutIntervenant;
use App\Form\StatutIntervenantType;
use App\Repository\StatutIntervenantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/intervenant')]
class StatutIntervenantController extends AbstractController
{
    #[Route('/', name: 'app_statut_intervenant_index', methods: ['GET'])]
    public function index(StatutIntervenantRepository $statutIntervenantRepository): Response
    {
        return $this->render('statut_intervenant/index.html.twig', [
            'statut_intervenants' => $statutIntervenantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_intervenant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutIntervenantRepository $statutIntervenantRepository): Response
    {
        $statutIntervenant = new StatutIntervenant();
        $form = $this->createForm(StatutIntervenantType::class, $statutIntervenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutIntervenantRepository->save($statutIntervenant, true);

            return $this->redirectToRoute('app_statut_intervenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_intervenant/new.html.twig', [
            'statut_intervenant' => $statutIntervenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_intervenant_show', methods: ['GET'])]
    public function show(StatutIntervenant $statutIntervenant): Response
    {
        return $this->render('statut_intervenant/show.html.twig', [
            'statut_intervenant' => $statutIntervenant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_intervenant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutIntervenant $statutIntervenant, StatutIntervenantRepository $statutIntervenantRepository): Response
    {
        $form = $this->createForm(StatutIntervenantType::class, $statutIntervenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutIntervenantRepository->save($statutIntervenant, true);

            return $this->redirectToRoute('app_statut_intervenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_intervenant/edit.html.twig', [
            'statut_intervenant' => $statutIntervenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_intervenant_delete', methods: ['POST'])]
    public function delete(Request $request, StatutIntervenant $statutIntervenant, StatutIntervenantRepository $statutIntervenantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutIntervenant->getId(), $request->request->get('_token'))) {
            $statutIntervenantRepository->remove($statutIntervenant, true);
        }

        return $this->redirectToRoute('app_statut_intervenant_index', [], Response::HTTP_SEE_OTHER);
    }
}
