<?php

namespace App\Controller;

use App\Entity\Accompte;
use App\Form\AccompteType;
use App\Repository\AccompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/accompte')]
class AccompteController extends AbstractController
{
    #[Route('/', name: 'app_accompte_index', methods: ['GET'])]
    public function index(AccompteRepository $accompteRepository): Response
    {
        return $this->render('accompte/index.html.twig', [
            'accomptes' => $accompteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_accompte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AccompteRepository $accompteRepository): Response
    {
        $accompte = new Accompte();
        $form = $this->createForm(AccompteType::class, $accompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accompteRepository->save($accompte, true);

            return $this->redirectToRoute('app_accompte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('accompte/new.html.twig', [
            'accompte' => $accompte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accompte_show', methods: ['GET'])]
    public function show(Accompte $accompte): Response
    {
        return $this->render('accompte/show.html.twig', [
            'accompte' => $accompte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_accompte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Accompte $accompte, AccompteRepository $accompteRepository): Response
    {
        $form = $this->createForm(AccompteType::class, $accompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accompteRepository->save($accompte, true);

            return $this->redirectToRoute('app_devis_edit', ['id' => $accompte->getdevis()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('accompte/edit.html.twig', [
            'accompte' => $accompte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_accompte_delete', methods: ['POST'])]
    public function delete(Request $request, Accompte $accompte, AccompteRepository $accompteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accompte->getId(), $request->request->get('_token'))) {
            $accompteRepository->remove($accompte, true);
        }

        return $this->redirectToRoute('app_devis_edit', ['id' => $accompte->getdevis()->getId()], Response::HTTP_SEE_OTHER);
    }
}
