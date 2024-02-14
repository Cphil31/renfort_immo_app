<?php

namespace App\Controller;

use App\Entity\StatutAdresse;
use App\Form\StatutAdresseType;
use App\Repository\StatutAdresseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/adresse')]
class StatutAdresseController extends AbstractController
{
    #[Route('/', name: 'app_statut_adresse_index', methods: ['GET'])]
    public function index(StatutAdresseRepository $statutAdresseRepository): Response
    {
        return $this->render('statut_adresse/index.html.twig', [
            'statut_adresses' => $statutAdresseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_adresse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutAdresseRepository $statutAdresseRepository): Response
    {
        $statutAdresse = new StatutAdresse();
        $form = $this->createForm(StatutAdresseType::class, $statutAdresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutAdresseRepository->save($statutAdresse, true);

            return $this->redirectToRoute('app_statut_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_adresse/new.html.twig', [
            'statut_adresse' => $statutAdresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_adresse_show', methods: ['GET'])]
    public function show(StatutAdresse $statutAdresse): Response
    {
        return $this->render('statut_adresse/show.html.twig', [
            'statut_adresse' => $statutAdresse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_adresse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutAdresse $statutAdresse, StatutAdresseRepository $statutAdresseRepository): Response
    {
        $form = $this->createForm(StatutAdresseType::class, $statutAdresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutAdresseRepository->save($statutAdresse, true);

            return $this->redirectToRoute('app_statut_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_adresse/edit.html.twig', [
            'statut_adresse' => $statutAdresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_adresse_delete', methods: ['POST'])]
    public function delete(Request $request, StatutAdresse $statutAdresse, StatutAdresseRepository $statutAdresseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutAdresse->getId(), $request->request->get('_token'))) {
            $statutAdresseRepository->remove($statutAdresse, true);
        }

        return $this->redirectToRoute('app_statut_adresse_index', [], Response::HTTP_SEE_OTHER);
    }
}
