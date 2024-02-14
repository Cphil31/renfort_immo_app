<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'entreprises' )]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutEntreprise $statut = null;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Adresse::class , orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $adresses;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $raison_sociale = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $siret = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $naf = null;


    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Mail::class)]
    private Collection $mails;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Profession::class, orphanRemoval: true)]
    private Collection $professions;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Note::class, orphanRemoval:true)]
    private Collection $notes;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Historique::class, orphanRemoval:true)]
    private Collection $historiques;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Intervenant::class ,orphanRemoval:true)]
    private Collection $intervenants;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Telephone::class , orphanRemoval:true)]
    private Collection $telephones;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Mission::class)]
    private Collection $missions;



    

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->mails = new ArrayCollection();
        $this->professions = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->historiques = new ArrayCollection();
        $this->intervenants = new ArrayCollection();
        $this->telephones = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?StatutEntreprise
    {
        return $this->statut;
    }

    public function setStatut(?StatutEntreprise $statut): self
    {
        $this->statut = $statut;

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
            $adress->setEntreprise($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getEntreprise() === $this) {
                $adress->setEntreprise(null);
            }
        }

        return $this;
    }


    public function getRaisonSociale(): ?string
    {
        return $this->raison_sociale;
    }

    public function setRaisonSociale(string $raison_sociale): self
    {
        $this->raison_sociale = $raison_sociale;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNaf(): ?string
    {
        return $this->naf;
    }

    public function setNaf(?string $naf): self
    {
        $this->naf = $naf;

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
            $mail->setEntreprise($this);
        }

        return $this;
    }

    public function removeMail(Mail $mail): self
    {
        if ($this->mails->removeElement($mail)) {
            // set the owning side to null (unless already changed)
            if ($mail->getEntreprise() === $this) {
                $mail->setEntreprise(null);
            }
        }

        return $this;
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
            $profession->setEntreprise($this);
        }

        return $this;
    }

    public function removeProfession(Profession $profession): self
    {
        if ($this->professions->removeElement($profession)) {
            // set the owning side to null (unless already changed)
            if ($profession->getEntreprise() === $this) {
                $profession->setEntreprise(null);
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
            $note->setEntreprise($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getEntreprise() === $this) {
                $note->setEntreprise(null);
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
            $historique->setEntreprise($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getEntreprise() === $this) {
                $historique->setEntreprise(null);
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

    public function addIntervenant(Intervenant $intervenant): self
    {
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants->add($intervenant);
            $intervenant->setEntreprise($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): self
    {
        if ($this->intervenants->removeElement($intervenant)) {
            // set the owning side to null (unless already changed)
            if ($intervenant->getEntreprise() === $this) {
                $intervenant->setEntreprise(null);
            }
        }

        return $this;
    }
    public function __toString() :string {
        return $this->raison_sociale;
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
            $telephone->setEntreprise($this);
        }

        return $this;
    }

    public function removeTelephone(Telephone $telephone): self
    {
        if ($this->telephones->removeElement($telephone)) {
            // set the owning side to null (unless already changed)
            if ($telephone->getEntreprise() === $this) {
                $telephone->setEntreprise(null);
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
            $mission->setEntreprise($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getEntreprise() === $this) {
                $mission->setEntreprise(null);
            }
        }

        return $this;
    }

   

}
