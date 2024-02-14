<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adresse')]
class AdresseController extends AbstractController
{
    #[Route('/', name: 'app_adresse_index', methods: ['GET'])]
    public function index(AdresseRepository $adresseRepository): Response
    {
        return $this->render('adresse/index.html.twig', [
            'adresses' => $adresseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_adresse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdresseRepository $adresseRepository): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adresseRepository->save($adresse, true);

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/new.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_show', methods: ['GET'])]
    public function show(Adresse $adresse): Response
    {
        return $this->render('adresse/show.html.twig', [
            'adresse' => $adresse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adresse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        $adressesDuContact = $adresseRepository->findBy(['contact' =>$adresse->getContact()->getId()]);


        if ($form->isSubmitted() && $form->isValid()) {

            if($adresse->isFacturation(1) )
            {
                foreach ($adressesDuContact as $ad) {
                    $ad->setFacturation(false);
                }

                $adresse->setFacturation(true);
            }

            
            $adresseRepository->save($adresse, true);

            if( $adresse->getEntreprise() == null && $adresse->getEntreprise() == null){
                return $this->redirectToRoute('app_contact_edit', ['id' => $adresse->getContact()->getId()], Response::HTTP_SEE_OTHER);
            }
            if($adresse->getContact() == null && $adresse->getProduit() == null){
                return $this->redirectToRoute('app_entreprise_edit', ['id' => $adresse->getEntreprise()->getId()], Response::HTTP_SEE_OTHER);
            }
            if($adresse->getContact() == null && $adresse->getEntreprise() == null)
            {
                return $this->redirectToRoute('app_produit_edit', ['id' => $adresse->getProduit()->getId()], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'app_adresse_delete', methods: ['POST'])]
    public function delete(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->request->get('_token'))) {
            $adresseRepository->remove($adresse, true);
        }

        if( $adresse->getEntreprise() == null && $adresse->getEntreprise() == null){
            return $this->redirectToRoute('app_contact_edit', ['id' => $adresse->getContact()->getId()], Response::HTTP_SEE_OTHER);
        }
        if($adresse->getContact() == null && $adresse->getProduit() == null){
            return $this->redirectToRoute('app_entreprise_edit', ['id' => $adresse->getEntreprise()->getId()], Response::HTTP_SEE_OTHER);
        }
        if($adresse->getContact() == null && $adresse->getEntreprise() == null)
        {
            return $this->redirectToRoute('app_produit_edit', ['id' => $adresse->getProduit()->getId()], Response::HTTP_SEE_OTHER);
        }
    }
}
