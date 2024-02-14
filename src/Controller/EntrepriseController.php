<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\Adresse;
use App\Entity\Contact;
use App\Entity\Telephone;
use App\Form\AdresseType;
use App\Entity\Entreprise;
use App\Entity\Profession;
use App\Entity\Intervenant;
use App\Form\EntrepriseType;
use App\Repository\NoteRepository;
use App\Repository\AdresseRepository;
use App\Repository\ContactRepository;
use App\Repository\TelephoneRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\ProfessionRepository;
use App\Repository\IntervenantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/entreprise')]
class EntrepriseController extends AbstractController
{
    #[Route('/', name: 'app_entreprise_index', methods: ['GET'])]
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('entreprise/index.html.twig', [
            'entreprises' => $entrepriseRepository->findBy(
                [],
                [
                    'raison_sociale' =>'ASC'
                ]
            ),
        ]);
    }

    #[Route('/new', name: 'app_entreprise_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntrepriseRepository $entrepriseRepository): Response
    {
        $entreprise = new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entrepriseRepository->save($entreprise, true);

            return $this->redirectToRoute('app_entreprise_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entreprise/new.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_entreprise_show', methods: ['GET'])]
    public function show(Entreprise $entreprise): Response
    {


        return $this->renderForm('entreprise/show.html.twig', [
            'entreprise' => $entreprise,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_entreprise_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entreprise $entreprise, EntrepriseRepository $entrepriseRepository, AdresseRepository $adresseRepository,TelephoneRepository $telephoneRepository,ProfessionRepository $professionRepository , NoteRepository $noteRepository): Response
    {
                    //new adresse
                    $adresse = new Adresse();
                    $formAdresse = $this->createForm(AdresseType::class, $adresse);
                    $formAdresse->handleRequest($request);
                    $adresse->setEntreprise($entreprise); 
                    $adresse->setContact(null);
                    if ($formAdresse->isSubmitted() && $formAdresse->isValid()) {
                        
                    $adresseRepository->save($adresse, true);
        
                    return $this->redirectToRoute('app_entreprise_edit', [ "id"=> $entreprise->getId()], Response::HTTP_SEE_OTHER);
                }
                //new adresse
        
                //new telephone
        
                $telephone = new Telephone();
                $formTel = $this->createFormBuilder($telephone)
                ->add('statut')
                ->add('number')
                ->add('observation')
                ->getForm();
                $formTel->handleRequest($request);
                
                if ($formTel->isSubmitted() && $formTel->isValid()) {
                    $telephone->setEntreprise($entreprise);
                    $telephone->setContact(null);
                    $telephoneRepository->save($telephone, true);
                    if($telephone->getEntreprise() == null)
                    {
                        return $this->redirectToRoute('app_contact_edit', ['id' =>$telephone->getContact()->getId() ], Response::HTTP_SEE_OTHER);
                    }
                    if($telephone->getContact() == null)
                    {
                        return $this->redirectToRoute('app_entreprise_edit', ['id' =>$telephone->getEntreprise()->getId() ], Response::HTTP_SEE_OTHER);
                    }
        
                }
                
        
                //new telephone
        
                // edit entreprise 
        $form = $this->createForm(EntrepriseType::class, $entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entrepriseRepository->save($entreprise, true);

            return $this->redirectToRoute('app_entreprise_edit', ['id'=> $entreprise->getId()], Response::HTTP_SEE_OTHER);
        }
         // edit entreprise

         //new intervenant
         $pro = new Profession();
         $pro->setEntreprise($entreprise);
         $formPro = $this->createFormBuilder($pro)
                ->add('contact' , EntityType::class, [
                    'class' => Contact::class,
                    'choice_label' => fn(Contact $contact) => $contact->getNom()." ".$contact->getPrenom(),
                    'multiple' => false,
                    'query_builder' => fn (ContactRepository $contactRepo) => $contactRepo->createQueryBuilder('c')->orderby('c.nom','ASC'),

                ] )
                ->add('profession')
                ->add('poste')
                ->getForm();
         $formPro->handleRequest($request);

         if ($formPro->isSubmitted() && $formPro->isValid()) {
            $professionRepository->save($pro, true);

            return $this->redirectToRoute('app_entreprise_edit', ['id' => $entreprise->getId()], Response::HTTP_SEE_OTHER);
        }

          //new intervenant
          // new note 
          $note = new Note();

          $formNote = $this->createFormBuilder($note)
                ->add('note')
                ->getForm();

          $formNote->handleRequest($request);

          if ($formNote->isSubmitted() && $formNote->isValid()) {
            $note->setEntreprise($entreprise);

            $noteRepository->save($note, true);

            return $this->redirectToRoute('app_entreprise_edit', ['id' => $entreprise->getId()], Response::HTTP_SEE_OTHER);
        }

          
          // new note 
          // new historique
        // new historique

        return $this->renderForm('entreprise/edit.html.twig', [
            'entreprise' => $entreprise,
            'form' => $form,
            'formAdresse' => $formAdresse,
            'formTel' => $formTel,
            'formPro' => $formPro,
            'formNote' => $formNote,
        ]);
    }

    #[Route('/{id}', name: 'app_entreprise_delete', methods: ['POST'])]
    public function delete(Request $request, Entreprise $entreprise, EntrepriseRepository $entrepriseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entreprise->getId(), $request->request->get('_token'))) {
            $entrepriseRepository->remove($entreprise, true);
        }

        return $this->redirectToRoute('app_entreprise_index', [], Response::HTTP_SEE_OTHER);
    }
}