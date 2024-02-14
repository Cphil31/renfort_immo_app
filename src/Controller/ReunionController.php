<?php

namespace App\Controller;

use App\Entity\Reunion;
use App\Form\ReunionType;
use App\Form\ReunionTacheType;
use App\Form\ReunionEditTacheType;
use App\Repository\ReunionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/reunion')]
class ReunionController extends AbstractController
{
    #[Route('/', name: 'app_reunion_index', methods: ['GET'])]
    public function index(ReunionRepository $reunionRepository): Response
    {
        return $this->render('reunion/index.html.twig', [
            'reunions' => $reunionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reunion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReunionRepository $reunionRepository): Response
    {
        $reunion = new Reunion();
        $form = $this->createForm(ReunionType::class, $reunion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reunionRepository->save($reunion, true);

            return $this->redirectToRoute('app_reunion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reunion/new.html.twig', [
            'reunion' => $reunion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reunion_show', methods: ['GET'])]
    public function show(Reunion $reunion): Response
    {
        return $this->render('reunion/show.html.twig', [
            'reunion' => $reunion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reunion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reunion $reunion, ReunionRepository $reunionRepository): Response
    {
        $form = $this->createForm(ReunionTacheType::class, $reunion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reunion->getTache($reunion->getTache());
            $reunionRepository->save($reunion, true);

            return $this->redirectToRoute('app_tache_edit', [ 'id' => $reunion->getTache()->getId() ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reunion/edit.html.twig', [
            'reunion' => $reunion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reunion_delete', methods: ['POST'])]
    public function delete(Request $request, Reunion $reunion, ReunionRepository $reunionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reunion->getId(), $request->request->get('_token'))) {
            $reunionRepository->remove($reunion, true);
        }

        return $this->redirectToRoute('app_tache_edit', [ 'id' => $reunion->getTache()->getId() ], Response::HTTP_SEE_OTHER);
    }
}
