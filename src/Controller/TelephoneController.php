<?php

namespace App\Controller;

use App\Entity\Telephone;
use App\Form\TelephoneType;
use App\Repository\TelephoneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/telephone')]
class TelephoneController extends AbstractController
{
    #[Route('/', name: 'app_telephone_index', methods: ['GET'])]
    public function index(TelephoneRepository $telephoneRepository): Response
    {
        return $this->render('telephone/index.html.twig', [
            'telephones' => $telephoneRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_telephone_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TelephoneRepository $telephoneRepository): Response
    {
        $telephone = new Telephone();
        $form = $this->createForm(TelephoneType::class, $telephone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $telephoneRepository->save($telephone, true);

            return $this->redirectToRoute('app_telephone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('telephone/new.html.twig', [
            'telephone' => $telephone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_telephone_show', methods: ['GET'])]
    public function show(Telephone $telephone): Response
    {
        return $this->render('telephone/show.html.twig', [
            'telephone' => $telephone,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_telephone_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Telephone $telephone, TelephoneRepository $telephoneRepository): Response
    {
        
        $form = $this->createFormBuilder($telephone)
        ->add('statut')
        ->add('number',TelType::class)
        ->add('observation')
        ->getForm();
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $telephone->setContact($telephone->getContact());
            $telephoneRepository->save($telephone, true);
            if ( $telephone->getEntreprise() == null)
            {
                return $this->redirectToRoute('app_contact_edit', ['id' =>$telephone->getContact()->getId() ], Response::HTTP_SEE_OTHER);
            }
            if ( $telephone->getContact() == null)  
            {
                return $this->redirectToRoute('app_entreprise_edit', ['id' =>$telephone->getEntreprise()->getId() ], Response::HTTP_SEE_OTHER);
            }

        }

        return $this->renderForm('telephone/edit.html.twig', [
            'telephone' => $telephone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_telephone_delete', methods: ['POST'])]
    public function delete(Request $request, Telephone $telephone, TelephoneRepository $telephoneRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$telephone->getId(), $request->request->get('_token'))) {
            $telephoneRepository->remove($telephone, true);
        }

        return $this->redirectToRoute('app_contact_edit', ['id' =>$telephone->getContact()->getId() ], Response::HTTP_SEE_OTHER);
    }
}
