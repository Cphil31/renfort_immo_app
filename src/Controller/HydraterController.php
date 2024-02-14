<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Entity\Etat;
use App\Entity\Identification;
use App\Entity\StatutMail;
use App\Entity\StatutAdresse;
use App\Entity\StatutContact;
use App\Entity\StatutProbleme;
use App\Entity\StatutTelephone;
use App\Entity\StatutDeplacement;
use App\Entity\StatutIntervenant;
use App\Entity\StatutEtatDesLieux;
use App\Entity\StatutCommunication;
use App\Entity\StatutTache;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HydraterController extends AbstractController
{
    #[Route('/hydrater', name: 'app_hydrater')]
    public function index(EntityManagerInterface $ent): Response
    {
        /*
        $statutContactTab = [];
        $statutmandant = new StatutContact();
        $statutmandant->setStatut('Mandant');
        $ent->persist($statutmandant);
        
        $statutIntervenant = new StatutContact();
        $statutIntervenant->setStatut('Intervenant');
        $ent->persist($statutIntervenant);
        
        $statutPrescripteur = new StatutContact();
        $statutPrescripteur->setStatut('Prescripteur');
        $ent->persist($statutPrescripteur);
        
        
        $statutContact = new StatutContact();
        $statutContact->setStatut('Contact');
        $ent->persist($statutContact);
        
        
        
        $statutprospect = new StatutContact();
        $statutprospect->setStatut('Prospect');
        $ent->persist($statutprospect);
        
        
        $statutautre = new StatutContact();
        $statutautre->setStatut('...');
        $ent->persist($statutautre);
        
        
        $statutAdresseBureau= new StatutAdresse();
        $statutAdresseBureau->setStatut("Bureau");
        $ent->persist($statutAdresseBureau);
        
        $statutAdressedomicile= new StatutAdresse();
        $statutAdressedomicile->setStatut("Domicile");
        $ent->persist($statutAdressedomicile);
        
        
        $statutAdresselocal= new StatutAdresse();
        $statutAdresselocal->setStatut("Autre");
        $ent->persist($statutAdresselocal);
        

        
        
        $statutEtatBorne= new StatutEtatDesLieux();
        $statutEtatBorne->setStatut("Borne");
        $ent->persist($statutEtatBorne);
        

        $statutEtatelectricité= new StatutEtatDesLieux();
        $statutEtatelectricité->setStatut("Electricité");
        $ent->persist($statutEtatelectricité);
        

        $statutEtateaupotable= new StatutEtatDesLieux();
        $statutEtateaupotable->setStatut("Eau potable");
        $ent->persist($statutEtateaupotable);
        

        $statutEtatservitude= new StatutEtatDesLieux();
        $statutEtatservitude->setStatut("Servitudes de passage");
        $ent->persist($statutEtatservitude);
        

        $statutEtatservitudeReseau= new StatutEtatDesLieux();
        $statutEtatservitudeReseau->setStatut("Servitudes de reseaux");
        $ent->persist($statutEtatservitudeReseau);
        

        $statutEtatnuissances= new StatutEtatDesLieux();
        $statutEtatnuissances->setStatut("Nuissances sonores");
        $ent->persist($statutEtatnuissances);
        

        $statutEtatnuisancesOlfactives= new StatutEtatDesLieux();
        $statutEtatnuisancesOlfactives->setStatut("Nuissances olfactives");
        $ent->persist($statutEtatnuisancesOlfactives);
        

        $statutEtatClotures = new StatutEtatDesLieux();
        $statutEtatClotures->setStatut("Clôtures");
        $ent->persist($statutEtatClotures);
        

        $statutEtatBatiments= new StatutEtatDesLieux();
        $statutEtatBatiments->setStatut("composition et état des bâtiments");
        $ent->persist($statutEtatBatiments);
        

        $statutEtatBatiments= new StatutEtatDesLieux();
        $statutEtatBatiments->setStatut("composition et état des bâtiments");
        $ent->persist($statutEtatBatiments);
        

        $statutEtatAcces= new StatutEtatDesLieux();
        $statutEtatAcces->setStatut("accès et praticabilité");
        $ent->persist($statutEtatAcces);
        

        $statutEtatInondations= new StatutEtatDesLieux();
        $statutEtatInondations->setStatut("Inondations");
        $ent->persist($statutEtatInondations);
        

        $statutEtatVoisinage= new StatutEtatDesLieux();
        $statutEtatVoisinage->setStatut("problèmes de voisinage");
        $ent->persist($statutEtatVoisinage);
        

        $statutEtatCouloir= new StatutEtatDesLieux();
        $statutEtatCouloir->setStatut("couloir aérien");
        $ent->persist($statutEtatCouloir);
        

        $statutEtatEmplacement= new StatutEtatDesLieux();
        $statutEtatEmplacement->setStatut("emplacement réservé");
        $ent->persist($statutEtatEmplacement);
        

        $statutEtatProjet= new StatutEtatDesLieux();
        $statutEtatProjet->setStatut("projet à proximité");
        $ent->persist($statutEtatProjet);
        

        $statutEtatIncendie= new StatutEtatDesLieux();
        $statutEtatIncendie->setStatut("risque incendie");
        $ent->persist($statutEtatIncendie);
        

        $statutEtatAbf= new StatutEtatDesLieux();
        $statutEtatAbf->setStatut("abf");
        $ent->persist($statutEtatAbf);
        

        $statutEtatArcheo= new StatutEtatDesLieux();
        $statutEtatArcheo->setStatut("diagnostic archéologique");
        $ent->persist($statutEtatArcheo);
        

        $statutEtatVoisin= new StatutEtatDesLieux();
        $statutEtatVoisin->setStatut("contact des voisins");
        $ent->persist($statutEtatVoisin);
        

        $statutEtatadm= new StatutEtatDesLieux();
        $statutEtatadm->setStatut("contacts adm");
        $ent->persist($statutEtatadm);
        

        $statutEtatparking= new StatutEtatDesLieux();
        $statutEtatparking->setStatut("stationnement et parking nb");
        $ent->persist($statutEtatparking);
        

        $statutEtatHistoire = new StatutEtatDesLieux();
        $statutEtatHistoire->setStatut("Histoire du secteur et du site");
        $ent->persist($statutEtatHistoire);
        

        $statutEtatIndices = new StatutEtatDesLieux();
        $statutEtatIndices->setStatut("indices de valorisation du site");
        $ent->persist($statutEtatIndices);
        

        $statutEtatAutre = new StatutEtatDesLieux();
        $statutEtatAutre->setStatut("autres");
        $ent->persist($statutEtatAutre);
        

        
        $statutComTelephone = new StatutCommunication();
        $statutComTelephone->setStatut("Téléphone");
        $ent->persist($statutComTelephone);
        

        $statutComMail = new StatutCommunication();
        $statutComMail->setStatut("Mail");
        $ent->persist($statutComMail);
        

        $statutComCourrier = new StatutCommunication();
        $statutComCourrier->setStatut("Courrier");
        $ent->persist($statutComCourrier);
        

        $statutDepVoiture = new StatutDeplacement() ;
        $statutDepVoiture->setStatut("Voiture perso");
        $ent->persist($statutDepVoiture);

        $statutDepTaxi = new StatutDeplacement() ;
        $statutDepTaxi->setStatut("Taxi");
        $ent->persist($statutDepTaxi);

        $statutDepTrain = new StatutDeplacement() ;
        $statutDepTrain->setStatut("Train");
        $ent->persist($statutDepTrain);

        $statutDepTram = new StatutDeplacement() ;
        $statutDepTram->setStatut("Tram");
        $ent->persist($statutDepTram);

        $statutDepMetro = new StatutDeplacement() ;
        $statutDepMetro->setStatut("Métro");
        $ent->persist($statutDepMetro);

        $statutDepAvion = new StatutDeplacement() ;
        $statutDepAvion->setStatut("Avion");
        $ent->persist($statutDepAvion);
        

        $statutIntClient = new StatutIntervenant() ;
        $statutIntClient->setStatut("Client");
        $ent->persist($statutIntClient);

        $statutIntMandant = new StatutIntervenant() ;
        $statutIntMandant->setStatut("Mandant");
        $ent->persist($statutIntMandant);

        $statutIntInt = new StatutIntervenant() ;
        $statutIntInt->setStatut("Intervenant");
        $ent->persist($statutIntInt);

        $statutIntPrescipteur = new StatutIntervenant() ;
        $statutIntPrescipteur->setStatut("Prescripteur");
        $ent->persist($statutIntPrescipteur);

        $statutIntContact = new StatutIntervenant() ;
        $statutIntContact->setStatut("Contact");
        $ent->persist($statutIntContact);

        $statutIntProspect = new StatutIntervenant() ;
        $statutIntProspect->setStatut("Prospect");
        $ent->persist($statutIntProspect);

        $statutIntautre = new StatutIntervenant() ;
        $statutIntautre->setStatut("Autre");
        $ent->persist($statutIntautre);

        

        $statutMailPro = new StatutMail() ;
        $statutMailPro->setStatut("Personnel");
        $ent->persist($statutMailPro);

        $statutMailPerso = new StatutMail() ;
        $statutMailPerso->setStatut("Personnel");
        $ent->persist($statutMailPerso);

        $statutMailAutre = new StatutMail() ;
        $statutMailAutre->setStatut("Autre");
        $ent->persist($statutMailAutre);

        
        $statutprobJur = new StatutProbleme() ;
        $statutprobJur->setStatut("Juridique");
        $ent->persist($statutprobJur);
        
        $statutprobTech = new StatutProbleme() ;
        $statutprobTech->setStatut("Technique");
        $ent->persist($statutprobTech);
        
        $statutprobCom = new StatutProbleme() ;
        $statutprobCom->setStatut("Commercial");
        $ent->persist($statutprobCom);
        
        
        $statuttelBur = new StatutTelephone() ;
        $statuttelBur->setStatut("Bureau");
        $ent->persist($statuttelBur);
        
        $statuttelTech = new StatutTelephone() ;
        $statuttelTech->setStatut("Domicile");
        $ent->persist($statuttelTech);
        
        $statuttelCom = new StatutTelephone() ;
        $statuttelCom->setStatut("Portable");
        $ent->persist($statuttelCom);
        

        
        $statutTacheAfaire = new StatutTache();
        $statutTacheAfaire->setName('A faire');
        $ent->persist($statutTacheAfaire);
        
        $statutTacheEnCours = new StatutTache();
        $statutTacheEnCours->setName('En cours');
        $ent->persist($statutTacheEnCours);
        
        $statutTacheok = new StatutTache();
        $statutTacheok->setName('ok');
        $ent->persist($statutTacheok);
        

        $IdentificationFoncier = new Identification();
        $IdentificationFoncier->setIdentification('Foncier');
        $ent->persist($IdentificationFoncier);

        $IdentificationImmeuble = new Identification();
        $IdentificationImmeuble->setIdentification('Immeuble');
        $ent->persist($IdentificationImmeuble);

        $IdentificationFi = new Identification();
        $IdentificationFi->setIdentification('Foncier + Immeuble');
        $ent->persist($IdentificationFi);
        
        $Identificationinfrastructure = new Identification();
        $Identificationinfrastructure->setIdentification('Infrastructure');
        $ent->persist($Identificationinfrastructure);
        
        $IdentificationAutre = new Identification();
        $IdentificationAutre->setIdentification('Autre');
        $ent->persist($IdentificationAutre);
        
        
        
        $titrePropriete = new Classe();
        $titrePropriete->setName("Titre de propriété");
        $ent->persist($titrePropriete);
        
        
        $indivision = new Classe();
        $indivision->setName("Indivision");
        $ent->persist($indivision);
        
        $autre = new Classe();
        $autre->setName("autre");
        $ent->persist($autre);
        
        $acces = new Classe();
        $acces->setName("accès");
        $ent->persist($acces);
        
        $limite = new Classe();
        $limite->setName("Limite");
        $ent->persist($limite);
        
        $assiette = new Classe();
        $assiette->setName("Assiette");
        $ent->persist($assiette);
        
        $bornage = new Classe();
        $bornage->setName("Bornage");
        $ent->persist($bornage);
        
        $servitude = new Classe();
        $servitude->setName("Servitude de passage");
        $ent->persist($servitude);
        
        $reseaux = new Classe();
        $reseaux->setName("Servitude réseaux");
        $ent->persist($reseaux);

        $negotiation = new Classe();
        $negotiation->setName("Négociation");
        $ent->persist($negotiation);
        
        $offre = new Classe();
        $offre->setName("Offre");
        $ent->persist($offre);
        
        
        
        $construireEtat = new Etat();
        $construireEtat->setEtat("à construire");
        $ent->persist($construireEtat);
        
        $renoverEtat = new Etat();
        $renoverEtat->setEtat("à rénover");
        $ent->persist($renoverEtat);

        $detruireEtat= new Etat();
        $detruireEtat->setEtat("à détruire");
        $ent->persist($detruireEtat);
        
        $trouverEtat = new Etat();
        $trouverEtat->setEtat("à trouver");
        $ent->persist($trouverEtat);
        
        $acheterEtat = new Etat();
        $acheterEtat->setEtat("à acheter");
        $ent->persist($acheterEtat);

        $vendreEtat = new Etat();
        $vendreEtat->setEtat("à vendre");
        $ent->persist($vendreEtat);
        
        
        $ent->flush();
        

        */

        
        
        
        return $this->renderForm('hydrater/index.html.twig', [
            'controller_name' => 'Hydrater',
        ]);
    }
}
