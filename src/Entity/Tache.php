<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Probleme $probleme = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;


    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: Moyen::class , orphanRemoval: true)]
    private Collection $moyens;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: Forfait::class , orphanRemoval: true)]
    private Collection $forfaits;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: Intervenant::class , orphanRemoval: true)]
    private Collection $intervenants;



    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: Document::class,orphanRemoval: true)]
    private Collection $documents;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: Communication::class, orphanRemoval: true)]
    private Collection $communications;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: Hebergement::class)]
    private Collection $hebergements;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: Restauration::class)]
    private Collection $restaurations;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: Reunion::class, orphanRemoval: true)]
    private Collection $reunions;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: Deplacement::class)]
    private Collection $deplacements;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutTache $statut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    private ?user $owner = null;


    public function __construct()
    {
        $this->forfaits = new ArrayCollection();
        $this->moyens = new ArrayCollection();
        $this->intervenants = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->communications = new ArrayCollection();
        $this->hebergements = new ArrayCollection();
        $this->restaurations = new ArrayCollection();
        $this->reunions = new ArrayCollection();
        $this->deplacements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProbleme(): ?Probleme
    {
        return $this->probleme;
    }

    public function setProbleme(?Probleme $probleme): self
    {
        $this->probleme = $probleme;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Moyen>
     */
    public function getMoyens(): Collection
    {
        return $this->moyens;
    }

    public function addMoyen(Moyen $moyen): self
    {
        if (!$this->moyens->contains($moyen)) {
            $this->moyens->add($moyen);
            $moyen->setTache($this);
        }

        return $this;
    }

    public function removeMoyen(Moyen $moyen): self
    {
        if ($this->moyens->removeElement($moyen)) {
            // set the owning side to null (unless already changed)
            if ($moyen->getTache() === $this) {
                $moyen->setTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Forfait>
     */
    public function getForfaits(): Collection
    {
        return $this->forfaits;
    }

    public function addForfait(Forfait $forfait): self
    {
        if (!$this->forfaits->contains($forfait)) {
            $this->forfaits->add($forfait);
            $forfait->setTache($this);
        }

        return $this;
    }

    public function removeForfait(Forfait $forfait): self
    {
        if ($this->forfaits->removeElement($forfait)) {
            // set the owning side to null (unless already changed)
            if ($forfait->getTache() === $this) {
                $forfait->setTache(null);
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
            $intervenant->setTache($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): self
    {
        if ($this->intervenants->removeElement($intervenant)) {
            // set the owning side to null (unless already changed)
            if ($intervenant->getTache() === $this) {
                $intervenant->setTache(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setTache($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getTache() === $this) {
                $document->setTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Communication>
     */
    public function getCommunications(): Collection
    {
        return $this->communications;
    }

    public function addCommunication(Communication $communication): self
    {
        if (!$this->communications->contains($communication)) {
            $this->communications->add($communication);
            $communication->setTache($this);
        }

        return $this;
    }

    public function removeCommunication(Communication $communication): self
    {
        if ($this->communications->removeElement($communication)) {
            // set the owning side to null (unless already changed)
            if ($communication->getTache() === $this) {
                $communication->setTache(null);
            }
        }

        return $this;
    }
    public function __toString() :string {
        return $this->description;
    }

    /**
     * @return Collection<int, Hebergement>
     */
    public function getHebergements(): Collection
    {
        return $this->hebergements;
    }

    public function addHebergement(Hebergement $hebergement): self
    {
        if (!$this->hebergements->contains($hebergement)) {
            $this->hebergements->add($hebergement);
            $hebergement->setTache($this);
        }

        return $this;
    }

    public function removeHebergement(Hebergement $hebergement): self
    {
        if ($this->hebergements->removeElement($hebergement)) {
            // set the owning side to null (unless already changed)
            if ($hebergement->getTache() === $this) {
                $hebergement->setTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Restauration>
     */
    public function getRestaurations(): Collection
    {
        return $this->restaurations;
    }

    public function addRestauration(Restauration $restauration): self
    {
        if (!$this->restaurations->contains($restauration)) {
            $this->restaurations->add($restauration);
            $restauration->setTache($this);
        }

        return $this;
    }

    public function removeRestauration(Restauration $restauration): self
    {
        if ($this->restaurations->removeElement($restauration)) {
            // set the owning side to null (unless already changed)
            if ($restauration->getTache() === $this) {
                $restauration->setTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reunion>
     */
    public function getReunions(): Collection
    {
        return $this->reunions;
    }

    public function addReunion(Reunion $reunion): self
    {
        if (!$this->reunions->contains($reunion)) {
            $this->reunions->add($reunion);
            $reunion->setTache($this);
        }

        return $this;
    }

    public function removeReunion(Reunion $reunion): self
    {
        if ($this->reunions->removeElement($reunion)) {
            // set the owning side to null (unless already changed)
            if ($reunion->getTache() === $this) {
                $reunion->setTache(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Deplacement>
     */
    public function getDeplacements(): Collection
    {
        return $this->deplacements;
    }

    public function addDeplacement(Deplacement $deplacement): self
    {
        if (!$this->deplacements->contains($deplacement)) {
            $this->deplacements->add($deplacement);
            $deplacement->setTache($this);
        }

        return $this;
    }

    public function removeDeplacement(Deplacement $deplacement): self
    {
        if ($this->deplacements->removeElement($deplacement)) {
            // set the owning side to null (unless already changed)
            if ($deplacement->getTache() === $this) {
                $deplacement->setTache(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?StatutTache
    {
        return $this->statut;
    }

    public function setStatut(?StatutTache $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getOwner(): ?user
    {
        return $this->owner;
    }

    public function setOwner(?user $owner): static
    {
        $this->owner = $owner;

        return $this;
    }


}
