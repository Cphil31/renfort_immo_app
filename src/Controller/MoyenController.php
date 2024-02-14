<?php

namespace App\Controller;

use App\Entity\Moyen;
use App\Form\MoyenType;
use App\Repository\MoyenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/moyen')]
class MoyenController extends AbstractController
{
    #[Route('/', name: 'app_moyen_index', methods: ['GET'])]
    public function index(MoyenRepository $moyenRepository): Response
    {
        return $this->render('moyen/index.html.twig', [
            'moyens' => $moyenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_moyen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MoyenRepository $moyenRepository): Response
    {
        $moyen = new Moyen();
        $form = $this->createForm(MoyenType::class, $moyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moyenRepository->save($moyen, true);

            return $this->redirectToRoute('app_moyen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('moyen/new.html.twig', [
            'moyen' => $moyen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_moyen_show', methods: ['GET'])]
    public function show(Moyen $moyen): Response
    {
        return $this->render('moyen/show.html.twig', [
            'moyen' => $moyen,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_moyen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Moyen $moyen, MoyenRepository $moyenRepository): Response
    {
        $form = $this->createForm(MoyenType::class, $moyen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moyenRepository->save($moyen, true);

            return $this->redirectToRoute('app_moyen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('moyen/edit.html.twig', [
            'moyen' => $moyen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_moyen_delete', methods: ['POST'])]
    public function delete(Request $request, Moyen $moyen, MoyenRepository $moyenRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moyen->getId(), $request->request->get('_token'))) {
            $moyenRepository->remove($moyen, true);
        }

        return $this->redirectToRoute('app_moyen_index', [], Response::HTTP_SEE_OTHER);
    }
}
