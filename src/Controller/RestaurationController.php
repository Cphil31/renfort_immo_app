<?php

namespace App\Controller;

use App\Entity\Restauration;
use App\Form\RestaurationTacheType;
use App\Form\RestaurationType;
use App\Repository\RestaurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/restauration')]
class RestaurationController extends AbstractController
{
    #[Route('/', name: 'app_restauration_index', methods: ['GET'])]
    public function index(RestaurationRepository $restaurationRepository): Response
    {
        return $this->render('restauration/index.html.twig', [
            'restaurations' => $restaurationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_restauration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RestaurationRepository $restaurationRepository): Response
    {
        $restauration = new Restauration();
        $form = $this->createForm(RestaurationType::class, $restauration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurationRepository->save($restauration, true);

            return $this->redirectToRoute('app_restauration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restauration/new.html.twig', [
            'restauration' => $restauration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_restauration_show', methods: ['GET'])]
    public function show(Restauration $restauration): Response
    {
        return $this->render('restauration/show.html.twig', [
            'restauration' => $restauration,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_restauration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Restauration $restauration, RestaurationRepository $restaurationRepository): Response
    {
        $form = $this->createForm(RestaurationTacheType::class, $restauration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restaurationRepository->save($restauration, true);

            return $this->redirectToRoute('app_tache_edit', ['id' => $restauration->getTache()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restauration/edit.html.twig', [
            'restauration' => $restauration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_restauration_delete', methods: ['POST'])]
    public function delete(Request $request, Restauration $restauration, RestaurationRepository $restaurationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restauration->getId(), $request->request->get('_token'))) {
            $restaurationRepository->remove($restauration, true);
        }

        return $this->redirectToRoute('app_tache_edit', ['id' => $restauration->getTache()->getId()], Response::HTTP_SEE_OTHER);
    }
}
