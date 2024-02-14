<?php

namespace App\Controller;

use App\Entity\StatutProbleme;
use App\Form\StatutProblemeType;
use App\Repository\StatutProblemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/probleme')]
class StatutProblemeController extends AbstractController
{
    #[Route('/', name: 'app_statut_probleme_index', methods: ['GET'])]
    public function index(StatutProblemeRepository $statutProblemeRepository): Response
    {
        return $this->render('statut_probleme/index.html.twig', [
            'statut_problemes' => $statutProblemeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_probleme_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutProblemeRepository $statutProblemeRepository): Response
    {
        $statutProbleme = new StatutProbleme();
        $form = $this->createForm(StatutProblemeType::class, $statutProbleme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutProblemeRepository->save($statutProbleme, true);

            return $this->redirectToRoute('app_statut_probleme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_probleme/new.html.twig', [
            'statut_probleme' => $statutProbleme,
            'form' => $form,
        ]);
    }
    /*
    */
    #[Route('/add', name: 'app_statut_probleme_add', methods: ['GET', 'POST'])]
    public function add(Request $request, StatutProblemeRepository $statutProblemeRepository): Response
    {
        $tabstatutProbleme = [];
        $statutProbleme = new StatutProbleme();
        $form = $this->createForm(StatutProblemeType::class, $statutProbleme);
        $form->handleRequest($request);

        $statutProbleme->setStatut("Juridique");

        $statutProblemeRepository->save($statutProbleme, true);
        

        return $this->renderForm('home/index.html.twig', [
        ]);
    }
    #[Route('/{id}', name: 'app_statut_probleme_show', methods: ['GET'])]
    public function show(StatutProbleme $statutProbleme): Response
    {
        return $this->render('statut_probleme/show.html.twig', [
            'statut_probleme' => $statutProbleme,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_probleme_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutProbleme $statutProbleme, StatutProblemeRepository $statutProblemeRepository): Response
    {
        $form = $this->createForm(StatutProblemeType::class, $statutProbleme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutProblemeRepository->save($statutProbleme, true);

            return $this->redirectToRoute('app_statut_probleme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_probleme/edit.html.twig', [
            'statut_probleme' => $statutProbleme,
            'form' => $form,
        ]);
    }



    #[Route('/{id}', name: 'app_statut_probleme_delete', methods: ['POST'])]
    public function delete(Request $request, StatutProbleme $statutProbleme, StatutProblemeRepository $statutProblemeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutProbleme->getId(), $request->request->get('_token'))) {
            $statutProblemeRepository->remove($statutProbleme, true);
        }

        return $this->redirectToRoute('app_statut_probleme_index', [], Response::HTTP_SEE_OTHER);
    }
}
