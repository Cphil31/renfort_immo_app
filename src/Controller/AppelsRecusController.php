<?php

namespace App\Controller;

use App\Entity\AppelsRecus;
use App\Form\AppelsRecusType;
use App\Repository\AppelsRecusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/appels/recus')]
class AppelsRecusController extends AbstractController
{
    #[Route('/', name: 'app_appels_recus_index', methods: ['GET'])]
    public function index(AppelsRecusRepository $appelsRecusRepository): Response
    {
        return $this->render('appels_recus/index.html.twig', [
            'appels_recuses' => $appelsRecusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_appels_recus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AppelsRecusRepository $appelsRecusRepository): Response
    {
        $appelsRecu = new AppelsRecus();
        $form = $this->createForm(AppelsRecusType::class, $appelsRecu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appelsRecusRepository->save($appelsRecu, true);

            return $this->redirectToRoute('app_appels_recus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('appels_recus/new.html.twig', [
            'appels_recu' => $appelsRecu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_appels_recus_show', methods: ['GET'])]
    public function show(AppelsRecus $appelsRecu): Response
    {
        
        return $this->render('appels_recus/show.html.twig', [
            'appels_recu' => $appelsRecu,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_appels_recus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AppelsRecus $appelsRecu, AppelsRecusRepository $appelsRecusRepository): Response
    {
        $form = $this->createForm(AppelsRecusType::class, $appelsRecu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appelsRecusRepository->save($appelsRecu, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('appels_recus/edit.html.twig', [
            'appels_recu' => $appelsRecu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_appels_recus_delete', methods: ['POST'])]
    public function delete(Request $request, AppelsRecus $appelsRecu, AppelsRecusRepository $appelsRecusRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appelsRecu->getId(), $request->request->get('_token'))) {
            $appelsRecusRepository->remove($appelsRecu, true);
        }

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
