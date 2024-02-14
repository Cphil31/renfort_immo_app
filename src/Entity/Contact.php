<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255 ,nullable: true)]
    private ?string $prenom = null;

    

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Adresse::class, orphanRemoval: true)]
    private Collection $adresses;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Mail::class, orphanRemoval: true)]
    private Collection $mails;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Profession::class , orphanRemoval: true)]
    private Collection $professions;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Note::class , orphanRemoval: true)]
    private Collection $notes;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Historique::class , orphanRemoval: true)]
    private Collection $historiques;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Intervenant::class, orphanRemoval: true)]
    private Collection $intervenants;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Telephone::class)]
    private Collection $telephones;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: AppelsRecus::class)]
    private Collection $appelsRecuses;

    

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Mission::class)]
    private Collection $missions;

    #[ORM\ManyToOne(inversedBy: 'contacts')]
    private ?StatutContact $statut = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $entreprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poste = null;



   

    public function __construct()
    {
        $this->telephones = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->mails = new ArrayCollection();
        $this->intervenants = new ArrayCollection();
        $this->professions = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->historiques = new ArrayCollection();
        $this->appelsRecuses = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses->add($adress);
            $adress->setContact($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getContact() === $this) {
                $adress->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mail>
     */
    public function getMails(): Collection
    {
        return $this->mails;
    }

    public function addMail(Mail $mail): self
    {
        if (!$this->mails->contains($mail)) {
            $this->mails->add($mail);
            $mail->setContact($this);
        }

        return $this;
    }

    public function removeMail(Mail $mail): self
    {
        if ($this->mails->removeElement($mail)) {
            // set the owning side to null (unless already changed)
            if ($mail->getContact() === $this) {
                $mail->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Intervenant>
     */
    public function getIntervenants(): Collection
    {
        return $this->intervenants;
    }

   

    /**
     * @return Collection<int, Profession>
     */
    public function getProfessions(): Collection
    {
        return $this->professions;
    }

    public function addProfession(Profession $profession): self
    {
        if (!$this->professions->contains($profession)) {
            $this->professions->add($profession);
            $profession->setContact($this);
        }

        return $this;
    }

    public function removeProfession(Profession $profession): self
    {
        if ($this->professions->removeElement($profession)) {
            // set the owning side to null (unless already changed)
            if ($profession->getContact() === $this) {
                $profession->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setContact($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getContact() === $this) {
                $note->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Historique>
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(Historique $historique): self
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques->add($historique);
            $historique->setContact($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getContact() === $this) {
                $historique->setContact(null);
            }
        }

        return $this;
    }

    public function addIntervenant(Intervenant $intervenant): self
    {
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants->add($intervenant);
            $intervenant->setContact($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): self
    {
        if ($this->intervenants->removeElement($intervenant)) {
            // set the owning side to null (unless already changed)
            if ($intervenant->getContact() === $this) {
                $intervenant->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Telephone>
     */
    public function getTelephones(): Collection
    {
        return $this->telephones;
    }

    public function addTelephone(Telephone $telephone): self
    {
        if (!$this->telephones->contains($telephone)) {
            $this->telephones->add($telephone);
            $telephone->setContact($this);
        }

        return $this;
    }

    public function removeTelephone(Telephone $telephone): self
    {
        if ($this->telephones->removeElement($telephone)) {
            // set the owning side to null (unless already changed)
            if ($telephone->getContact() === $this) {
                $telephone->setContact(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AppelsRecus>
     */
    public function getAppelsRecuses(): Collection
    {
        return $this->appelsRecuses;
    }

    public function addAppelsRecus(AppelsRecus $appelsRecus): self
    {
        if (!$this->appelsRecuses->contains($appelsRecus)) {
            $this->appelsRecuses->add($appelsRecus);
            $appelsRecus->setContact($this);
        }

        return $this;
    }

    public function removeAppelsRecus(AppelsRecus $appelsRecus): self
    {
        if ($this->appelsRecuses->removeElement($appelsRecus)) {
            // set the owning side to null (unless already changed)
            if ($appelsRecus->getContact() === $this) {
                $appelsRecus->setContact(null);
            }
        }

        return $this;
    }

   
    /**
     * @return Collection<int, Mission>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
            $mission->setContact($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getContact() === $this) {
                $mission->setContact(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?StatutContact
    {
        return $this->statut;
    }

    public function setStatut(?StatutContact $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(?string $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(?string $poste): static
    {
        $this->poste = $poste;

        return $this;
    }

   
   

}
