<?php

namespace App\Controller;

use App\Entity\Deplacement;
use App\Form\DeplacementType;
use App\Form\DeplacementTacheType;
use App\Repository\DeplacementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/deplacement')]
class DeplacementController extends AbstractController
{
    #[Route('/', name: 'app_deplacement_index', methods: ['GET'])]
    public function index(DeplacementRepository $deplacementRepository): Response
    {
        return $this->render('deplacement/index.html.twig', [
            'deplacements' => $deplacementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_deplacement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DeplacementRepository $deplacementRepository): Response
    {
        $deplacement = new Deplacement();
        $form = $this->createForm(DeplacementType::class, $deplacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deplacementRepository->save($deplacement, true);

            return $this->redirectToRoute('app_deplacement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('deplacement/new.html.twig', [
            'deplacement' => $deplacement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_deplacement_show', methods: ['GET'])]
    public function show(Deplacement $deplacement): Response
    {
        return $this->render('deplacement/show.html.twig', [
            'deplacement' => $deplacement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_deplacement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Deplacement $deplacement, DeplacementRepository $deplacementRepository): Response
    {
        $form = $this->createForm(DeplacementType::class, $deplacement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $deplacementRepository->save($deplacement, true);

            return $this->redirectToRoute('app_tache_edit', ['id' => $deplacement->getTache()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('deplacement/edit.html.twig', [
            'deplacement' => $deplacement,
            'form' => $form,
        ]);
    }



    #[Route('/{id}', name: 'app_deplacement_delete', methods: ['POST'])]
    public function delete(Request $request, Deplacement $deplacement, DeplacementRepository $deplacementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deplacement->getId(), $request->request->get('_token'))) {
            $deplacementRepository->remove($deplacement, true);
        }

        return $this->redirectToRoute('app_tache_edit', ['id' => $deplacement->getTache()->getId()], Response::HTTP_SEE_OTHER);
    }
}
