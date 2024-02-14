<?php

namespace App\Controller;

use Amp\Http\Status;
use App\Entity\AppelsRecus;
use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\Produit;
use App\Form\ContactType;
use App\Form\MissionType;
use App\Form\ProduitType;
use App\Entity\Entreprise;
use App\Entity\Mail;
use App\Entity\StatutAdresse;
use App\Entity\StatutCommunication;
use App\Entity\StatutContact;
use App\Entity\StatutDeplacement;
use App\Entity\StatutEtatDesLieux;
use App\Entity\StatutIntervenant;
use App\Entity\StatutMail;
use App\Entity\StatutProbleme;
use App\Entity\StatutTelephone;
use App\Form\AppelsRecusType;
use App\Form\EntrepriseType;
use App\Form\MailType;
use App\Repository\AppelsRecusRepository;
use App\Repository\TacheRepository;
use App\Repository\ContactRepository;
use App\Repository\MissionRepository;
use App\Repository\ProduitRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\MailRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\Type\DatalistType;
use App\Repository\StatutTacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
    Request $request, 
    ContactRepository $contactRepository,
    ProduitRepository $produitRepository,
    MissionRepository $missionRepository,
    TacheRepository $tacheRepository, 
    StatutTacheRepository $statutTacheRepository,
    EntrepriseRepository $entrepriseRepository,
    AppelsRecusRepository $appelsRecusRepository,
    MailRepository $mailRepository): Response
    {  
        //nouveau contact
        $contact = new Contact();
        $formNewContact = $this->createForm(ContactType::class, $contact);
        $formNewContact->handleRequest($request);

        if ($formNewContact->isSubmitted() && $formNewContact->isValid()) {
            $contactRepository->save($contact, true);

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
     
        $users = $contactRepository->findAll();
        //je crée mon formulaire
        $formContacts = $this->createFormBuilder()

        ->add( 'contact' , SearchType::class,[
            'attr' => [
                'placeholder' => 'Rechercher Contact'
              ]
            ])
              
        ->getForm();
        $formContacts->handleRequest($request);
        
        //je soumets mon formulaire 
        if ($formContacts->isSubmitted() && $formContacts->isValid()) {
            // je récupères les données de mon formulaire qui est retourné sous forme de tableau
            
            $result= $formContacts->get("contact")->getData();          
            
            
            return $this->redirectToRoute('app_search', [ 'q' =>$result ], Response::HTTP_SEE_OTHER);    
        }
        //liste des produits 
        $produits=  $produitRepository->findBy(
            [],
            ['name' =>'ASC']
        );

        
        
        //je crée mon formulaire produit 
        $formProduits = $this->createFormBuilder()
        ->add( 'produit' , SearchType::class,[
            'attr' => [
                'placeholder' => 'Rechercher Produit'
              ]
            ])
              
            /*
        ->add('name', DatalistType::class, [
            'required' => true,
            'label' => 'User',
            'class' => 'App\Entity\Produit',
            ])
            */
            
        ->getForm();
        $formProduits->handleRequest($request);

        //je soumets mon formulaire 
        
        if ($formProduits->isSubmitted() && $formProduits->isValid()) {
            // je récupères les données de mon formulaire qui est retourné sous forme de tableau
            $result= $formProduits->get("produit")->getData();
           
            
            //je retourne a la page
            return $this->redirectToRoute('app_search', [ 'q' =>$result ], Response::HTTP_SEE_OTHER);    
           
        }

        date_default_timezone_set("Europe/Paris");
        
        // je crée un nouveau produit 
        $produit = new Produit();
        $formNewProduit = $this->createForm(ProduitType::class, $produit);
        $formNewProduit->handleRequest($request);
        
        if ($formNewProduit->isSubmitted() && $formNewProduit->isValid()) {
            
            $produitRepository->save($produit, true);
            
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        
        
        //je crée mon formulaire des mission
        $missions= $missionRepository->findAll();

        $formMission = $this->createFormBuilder()
            ->add( 'mission' , SearchType::class,[
                'attr' => [
                            'placeholder' => 'Rechercher Mission'
                          ]
                
                ])
              
        ->getForm();
        $formMission->handleRequest($request);
                    
        //je soumets mon formulaire 
        if ($formMission->isSubmitted() && $formMission->isValid()) {
            
            $result= $formMission->get("mission")->getData();          

            return $this->redirectToRoute('app_search', [ 'q' =>$result ], Response::HTTP_SEE_OTHER);   
        }

                    // je crée une nouvelle mission 
                    $mission = new Mission();
                    $formNewMission = $this->createForm(MissionType::class, $mission);
                    $formNewMission->handleRequest($request);
                    
                    if ($formNewMission->isSubmitted() && $formNewMission->isValid()) {
                        $missionRepository->save($mission, true);
                        
                        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
                    }
                    
                    // je crée le liste des entreprises 

                    $formEntreprise = $this->createFormBuilder()
                    ->add('entreprise' , EntityType::class, [
                        'class' => Entreprise::class ,
                        'choice_label' => fn(Entreprise $entreprise) => $entreprise->getRaisonSociale(),
                        'multiple' => false,
                        'query_builder' => fn (EntrepriseRepository $entrepriseRepository) => $entrepriseRepository->createQueryBuilder('c')->orderby('c.raison_sociale','ASC'),
                        
                        ] )
                        ->getForm();
                        
                        $formEntreprise->handleRequest($request);
                        
                        if ($formEntreprise->isSubmitted() && $formEntreprise->isValid()) {
                            // je récupères les données de mon formulaire qui est retourné sous forme de tableau
                            $data= $formEntreprise->getData();
                            foreach ($data as  $d) {
                                //je récupère l'id que je mets dans une variable 
                                $id = $d->getId();     
             }
             //je retourne a la page
             return $this->redirectToRoute('app_entreprise_edit', ['id' => $id ], Response::HTTP_SEE_OTHER);
            }
            
            
            
            //ajouter une entreprise 
            
            $entreprise = new Entreprise();
            $formNewEntreprise = $this->createForm(EntrepriseType::class, $entreprise); ;
            $formNewEntreprise->handleRequest($request);
            
            if ($formNewEntreprise->isSubmitted() && $formNewEntreprise->isValid()) {
                $entrepriseRepository->save($entreprise, true);
                return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
            }
        
        //liste des produits 
        $calls =  $appelsRecusRepository->findBy(
            [],
            ['date' =>'DESC']
        );
        $appels =  array_slice($calls, 0, 3);
        
        
        // ajouter un appel
        
        $appel = new AppelsRecus();
        $formAppel = $this->createForm(AppelsRecusType::class,$appel);
        $formAppel->handleRequest($request);
        
        if ($formAppel->isSubmitted() && $formAppel->isValid()) {
            $appelsRecusRepository->save($appel, true);
            
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        
        //liste des mails
        
        $mails = $mailRepository->findby(
            [],
            ['created_at' => 'DESC']
        );
        $mailslist = array_slice($mails,0,3); 
        
        // Ajouter un mail 
        $mail = new Mail();
        $formMail = $this->createForm(MailType::class,$mail) ;
        $formMail->handleRequest($request);
        
        if ($formMail->isSubmitted() && $formMail->isValid()) {
            $mailRepository->save($mail, true);
            
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        
        // Liste des taches 
        
       
        $statutaFaire=$statutTacheRepository->findByName("A faire");
        $t = $tacheRepository->findByStatut($statutaFaire);  
        
        $taches= array_slice($t,0,3);

        //taches en cours
        $statutenCours=$statutTacheRepository->findByName("En cours");
        $tabEnCours = array_slice($tacheRepository->findByStatut($statutenCours),0,3) ; 

        $statutokTache=$statutTacheRepository->findByName("ok");
        $tabOk = array_slice($tacheRepository->findByStatut($statutokTache),0,3);


        $entreprises = $entrepriseRepository->findAll() ;

        
        
        return $this->renderForm('home/index.html.twig', [
            
            'formContacts' => $formContacts,
            'formProduits' => $formProduits,
            'formMission'=>$formMission,
            'produits' => $produits,
            'formNewContact' => $formNewContact,
            'formNewProduit' => $formNewProduit ,
            'formNewMission' => $formNewMission ,
            'formEntreprise' => $formEntreprise ,
            'formNewEntreprise' =>$formNewEntreprise,
            'formAppel' => $formAppel,
            'appels' => $appels,
            'mails' => $mailslist,
            'formMail' => $formMail,
            'tachesAFaire' => $taches,
            'tachesEnCours'=>$tabEnCours,
            'tachesOk'=>$tabOk,
            'users' =>$users,
            'missions' =>$missions,
        ]);
    }
    
}
