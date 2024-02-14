<?php

namespace App\Entity;

use App\Repository\DevisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevisRepository::class)]
class Devis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    

    #[ORM\Column(length: 255)]
    private ?string $name = null;



    #[ORM\ManyToOne(inversedBy: 'devis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mission $mission = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

   

    #[ORM\OneToMany(mappedBy: 'devis', targetEntity: DevisHebergement::class, orphanRemoval: true)]
    private Collection $devisHebergements;

    #[ORM\OneToMany(mappedBy: 'devis', targetEntity: DevisDeplacement::class, orphanRemoval: true)]
    private Collection $devisDeplacements;

    #[ORM\OneToMany(mappedBy: 'devis', targetEntity: DevisReunion::class, orphanRemoval: true)]
    private Collection $devisReunions;

    #[ORM\OneToMany(mappedBy: 'devis', targetEntity: DevisRestauration::class, orphanRemoval: true)]
    private Collection $devisRestaurations;

    #[ORM\OneToMany(mappedBy: 'devis', targetEntity: OuvertureDossier::class, orphanRemoval: true)]
    private Collection $ouvertureDossiers;

    #[ORM\OneToMany(mappedBy: 'devis', targetEntity: DevisPrestation::class, orphanRemoval: true)]
    private Collection $devisPrestations;

    #[ORM\OneToMany(mappedBy: 'devis', targetEntity: Accompte::class, orphanRemoval: true)]
    private Collection $accomptes;

    public function __construct()
    {
        $this->devisHebergements = new ArrayCollection();
        $this->devisDeplacements = new ArrayCollection();
        $this->devisReunions = new ArrayCollection();
        $this->devisRestaurations = new ArrayCollection();
        $this->ouvertureDossiers = new ArrayCollection();
        $this->devisPrestations = new ArrayCollection();
        $this->accomptes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function __toString() :string {
        return $this->name;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    

    /**
     * @return Collection<int, DevisHebergement>
     */
    public function getDevisHebergements(): Collection
    {
        return $this->devisHebergements;
    }

    public function addDevisHebergement(DevisHebergement $devisHebergement): self
    {
        if (!$this->devisHebergements->contains($devisHebergement)) {
            $this->devisHebergements->add($devisHebergement);
            $devisHebergement->setDevis($this);
        }

        return $this;
    }

    public function removeDevisHebergement(DevisHebergement $devisHebergement): self
    {
        if ($this->devisHebergements->removeElement($devisHebergement)) {
            // set the owning side to null (unless already changed)
            if ($devisHebergement->getDevis() === $this) {
                $devisHebergement->setDevis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DevisDeplacement>
     */
    public function getDevisDeplacements(): Collection
    {
        return $this->devisDeplacements;
    }

    public function addDevisDeplacement(DevisDeplacement $devisDeplacement): self
    {
        if (!$this->devisDeplacements->contains($devisDeplacement)) {
            $this->devisDeplacements->add($devisDeplacement);
            $devisDeplacement->setDevis($this);
        }

        return $this;
    }

    public function removeDevisDeplacement(DevisDeplacement $devisDeplacement): self
    {
        if ($this->devisDeplacements->removeElement($devisDeplacement)) {
            // set the owning side to null (unless already changed)
            if ($devisDeplacement->getDevis() === $this) {
                $devisDeplacement->setDevis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DevisReunion>
     */
    public function getDevisReunions(): Collection
    {
        return $this->devisReunions;
    }

    public function addDevisReunion(DevisReunion $devisReunion): self
    {
        if (!$this->devisReunions->contains($devisReunion)) {
            $this->devisReunions->add($devisReunion);
            $devisReunion->setDevis($this);
        }

        return $this;
    }

    public function removeDevisReunion(DevisReunion $devisReunion): self
    {
        if ($this->devisReunions->removeElement($devisReunion)) {
            // set the owning side to null (unless already changed)
            if ($devisReunion->getDevis() === $this) {
                $devisReunion->setDevis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DevisRestauration>
     */
    public function getDevisRestaurations(): Collection
    {
        return $this->devisRestaurations;
    }

    public function addDevisRestauration(DevisRestauration $devisRestauration): self
    {
        if (!$this->devisRestaurations->contains($devisRestauration)) {
            $this->devisRestaurations->add($devisRestauration);
            $devisRestauration->setDevis($this);
        }

        return $this;
    }

    public function removeDevisRestauration(DevisRestauration $devisRestauration): self
    {
        if ($this->devisRestaurations->removeElement($devisRestauration)) {
            // set the owning side to null (unless already changed)
            if ($devisRestauration->getDevis() === $this) {
                $devisRestauration->setDevis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OuvertureDossier>
     */
    public function getOuvertureDossiers(): Collection
    {
        return $this->ouvertureDossiers;
    }

    public function addOuvertureDossier(OuvertureDossier $ouvertureDossier): self
    {
        if (!$this->ouvertureDossiers->contains($ouvertureDossier)) {
            $this->ouvertureDossiers->add($ouvertureDossier);
            $ouvertureDossier->setDevis($this);
        }

        return $this;
    }

    public function removeOuvertureDossier(OuvertureDossier $ouvertureDossier): self
    {
        if ($this->ouvertureDossiers->removeElement($ouvertureDossier)) {
            // set the owning side to null (unless already changed)
            if ($ouvertureDossier->getDevis() === $this) {
                $ouvertureDossier->setDevis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DevisPrestation>
     */
    public function getDevisPrestations(): Collection
    {
        return $this->devisPrestations;
    }

    public function addDevisPrestation(DevisPrestation $devisPrestation): self
    {
        if (!$this->devisPrestations->contains($devisPrestation)) {
            $this->devisPrestations->add($devisPrestation);
            $devisPrestation->setDevis($this);
        }

        return $this;
    }

    public function removeDevisPrestation(DevisPrestation $devisPrestation): self
    {
        if ($this->devisPrestations->removeElement($devisPrestation)) {
            // set the owning side to null (unless already changed)
            if ($devisPrestation->getDevis() === $this) {
                $devisPrestation->setDevis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Accompte>
     */
    public function getAccomptes(): Collection
    {
        return $this->accomptes;
    }

    public function addAccompte(Accompte $accompte): self
    {
        if (!$this->accomptes->contains($accompte)) {
            $this->accomptes->add($accompte);
            $accompte->setDevis($this);
        }

        return $this;
    }

    public function removeAccompte(Accompte $accompte): self
    {
        if ($this->accomptes->removeElement($accompte)) {
            // set the owning side to null (unless already changed)
            if ($accompte->getDevis() === $this) {
                $accompte->setDevis(null);
            }
        }

        return $this;
    }
}
