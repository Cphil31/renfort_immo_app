<?php

namespace App\Controller;


use Dompdf\Dompdf;
use App\Entity\Mail;
use App\Entity\Note;
use App\Entity\Adresse;
use App\Entity\Contact;
use App\Entity\Telephone;
use App\Form\AdresseType;
use App\Form\ContactType;
use App\Entity\Historique;
use App\Form\AdresseContactType;
use App\Form\EditHistoriqueContactPageType;
use App\Repository\MailRepository;
use App\Repository\NoteRepository;
use App\Repository\AdresseRepository;
use App\Repository\ContactRepository;
use App\Repository\TelephoneRepository;
use App\Repository\HistoriqueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/contact')]
class ContactController extends AbstractController
{
    #[Route('/list', name: 'app_contact_index', methods: ['GET'])]
    public function index(ContactRepository $contactRepository): Response
    {
       
        return $this->renderForm('contact/index.html.twig',[
            'contacts'=> $contactRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_contact_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContactRepository $contactRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact, true);

            return $this->redirectToRoute('app_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_show', methods: ['GET'])]
    public function show(Contact $contact,Request $request,AdresseRepository $adresseRepository,AdresseType $adresseType): Response
    {
       

        return $this->renderForm('contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contact_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contact $contact, MailRepository $mailRepository , ContactRepository $contactRepository,AdresseRepository $adresseRepository,TelephoneRepository $telephoneRepository,HistoriqueRepository $historiqueRepository,NoteRepository $noteRepository): Response
    {

        //new adresse
        $adresse = new Adresse();
        $formAdresse = $this->createForm(AdresseType::class, $adresse);
        $formAdresse->handleRequest($request);
        //récuperer les adresses du contact 
        //le contact 
        $adressesDuContact = $adresseRepository->findBy(['contact' =>$contact->getId()]);
        
        if ($formAdresse->isSubmitted() && $formAdresse->isValid()) {
            $adresse->setContact($contact);
            /*
            if($adresse->setFacturation() == true ){
                
            }
            */
            if($adresse->isFacturation(1) )
            {
                foreach ($adressesDuContact as $ad) {
                    $ad->setFacturation(false);
                }

                $adresse->setFacturation(true);
            }
            $adresseRepository->save($adresse, true);

            return $this->redirectToRoute('app_contact_edit', ['id' => $contact->getId()], Response::HTTP_SEE_OTHER);
        }

        //new adresse


        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

  
        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact, true);

            return $this->redirectToRoute('app_contact_edit', ['id' => $contact->getId()], Response::HTTP_SEE_OTHER);
        }
        

         //new tel
         $telephone = new Telephone();
         $telephone->setContact($contact);
         $formTel = $this->createFormBuilder($telephone)
                ->add('statut')
                ->add('number')
                ->add('observation')
                ->getForm();
        $formTel->handleRequest($request);

        if ($formTel->isSubmitted() && $formTel->isValid()) {
            $telephoneRepository->save($telephone, true);

            return $this->redirectToRoute('app_contact_edit', ['id' => $contact->getId()], Response::HTTP_SEE_OTHER);
        }

         
         //new tel

         // New mail
         $mail = new Mail ();
         $formMail = $this->createFormBuilder($mail)
         ->add('statut')
         ->add('email')
         ->getForm();
         
         $formMail->handleRequest($request);
         
         if ($formMail->isSubmitted() && $formMail->isValid()) {
            $mail->setContact($contact);  
            $mailRepository->save($mail, true);

            return $this->redirectToRoute('app_contact_edit', ['id'=> $contact->getId() ], Response::HTTP_SEE_OTHER);
        }
         // New mail

         //New historique
         $historique = new Historique();
         $formHist = $this->createForm(EditHistoriqueContactPageType::class , $historique);
         $formHist->handleRequest($request);
        
         $today = new \DateTimeImmutable('now');
         
         
         if ($formHist->isSubmitted() && $formHist->isValid()) {
            $historique->setContact($contact);
            $historique->setCreatedAt($today);
            $historiqueRepository->save($historique, true);

            return $this->redirectToRoute('app_contact_edit', [ 'id' => $contact->getId() ], Response::HTTP_SEE_OTHER);
        }


         // New historique


         // ajouter une note
         // new  note
            $note = new Note();
            
            $formNote = $this->createFormBuilder($note)
            ->add('note')
            ->getForm();
            
            $formNote->handleRequest($request);
            
            if ($formNote->isSubmitted() && $formNote->isValid()) {
                $note->setContact($contact);
                $noteRepository->save($note, true);
    
                return $this->redirectToRoute('app_contact_edit', [ 'id' => $contact->getId() ], Response::HTTP_SEE_OTHER);
            }

        // new  note

        
        
        return $this->renderForm('contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form,
            'formAdresse' => $formAdresse,
            'formTel' => $formTel,
            'formMail' => $formMail,
            'formHist' => $formHist,
            'formNote' => $formNote,

        ]);
    }

    #[Route('/{id}/pdf', name: 'app_contact_pdf')]
    public function pdf(Request $request , Contact $contact   ): Response
    {
        
        /* 
        */
        
        $dompdf = new Dompdf();
        $html = $this->renderView('contact/edit/_contactPdf.html.twig', [
            'logo' => $this->imageToBase64($this->getParameter('kernel.project_dir') . '/public/Logo.png'),
            'nom' => $contact->getNom(),
            'prenom'=>$contact->getPrenom(),
            'statut'=>$contact->getStatut(),
            'entreprise'=>$contact->getEntreprise(),
            'adresses'=>$contact->getAdresses(),
            'historiques'=>$contact->getHistoriques(),
            'telephones'=>$contact->getTelephones(),
            'intervenants'=>$contact->getIntervenants(),
            'mails'=>$contact->getMails(),
            'notes'=>$contact->getNotes(),
            
        ]);
        $dompdf->loadHtml($html) ;
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        
        ob_get_clean();
        // Render the HTML as PDF
        $dompdf->render();
        $pdfTitre = "Fiche Contact : ".$contact->getNom()." ".$contact->getPrenom();
        // Output the generated PDF to Browser
        $dompdf->stream($pdfTitre, ["Attachment" => false]);
        
        return $this->render('contact/edit/_contactPdf.html.twig', [
            'controller_name' => 'HomeController',
        ]);
        
        
    }

    private function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    #[Route('/{id}', name: 'app_contact_delete', methods: ['GET','POST'])]
    public function delete(Request $request, Contact $contact, ContactRepository $contactRepository,AdresseRepository $adresseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $contactRepository->remove($contact, true);

        }

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}