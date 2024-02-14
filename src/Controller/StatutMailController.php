<?php

namespace App\Controller;

use App\Entity\StatutMail;
use App\Form\StatutMailType;
use App\Repository\StatutMailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/statut/mail')]
class StatutMailController extends AbstractController
{
    #[Route('/', name: 'app_statut_mail_index', methods: ['GET'])]
    public function index(StatutMailRepository $statutMailRepository): Response
    {
        return $this->render('statut_mail/index.html.twig', [
            'statut_mails' => $statutMailRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_statut_mail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, StatutMailRepository $statutMailRepository): Response
    {
        $statutMail = new StatutMail();
        $form = $this->createForm(StatutMailType::class, $statutMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutMailRepository->save($statutMail, true);

            return $this->redirectToRoute('app_statut_mail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_mail/new.html.twig', [
            'statut_mail' => $statutMail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_mail_show', methods: ['GET'])]
    public function show(StatutMail $statutMail): Response
    {
        return $this->render('statut_mail/show.html.twig', [
            'statut_mail' => $statutMail,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_statut_mail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatutMail $statutMail, StatutMailRepository $statutMailRepository): Response
    {
        $form = $this->createForm(StatutMailType::class, $statutMail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statutMailRepository->save($statutMail, true);

            return $this->redirectToRoute('app_statut_mail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statut_mail/edit.html.twig', [
            'statut_mail' => $statutMail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_statut_mail_delete', methods: ['POST'])]
    public function delete(Request $request, StatutMail $statutMail, StatutMailRepository $statutMailRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statutMail->getId(), $request->request->get('_token'))) {
            $statutMailRepository->remove($statutMail, true);
        }

        return $this->redirectToRoute('app_statut_mail_index', [], Response::HTTP_SEE_OTHER);
    }
}
