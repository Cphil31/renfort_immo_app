<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Analyse::class, orphanRemoval: true)]
    private Collection $analyses;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: EtatDesLieux::class, orphanRemoval: true)]
    private Collection $etatDesLieuxes;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Adresse::class, orphanRemoval: true)]
    private Collection $adresses;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Etat $etat = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Identification $identification = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $localisation = null;


    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Historique::class, orphanRemoval: true)]
    private Collection $historiques;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $carTechniques = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $carJuridiques = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $carCommerciales = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $environement = null;

   

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observation = null;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Intervenant::class)]
    private Collection $intervenants;

    #[ORM\ManyToMany(targetEntity: Mission::class, mappedBy: 'produit')]
    private Collection $missions;

   

    public function __construct()
    {
        $this->contact = new ArrayCollection();
        $this->missions = new ArrayCollection();
        $this->analyses = new ArrayCollection();
        $this->etatDesLieuxes = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->historiques = new ArrayCollection();
       
        $this->intervenants = new ArrayCollection();
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

  
   
    /**
     * @return Collection<int, Analyse>
     */
    public function getAnalyses(): Collection
    {
        return $this->analyses;
    }

    public function addAnalysis(Analyse $analysis): self
    {
        if (!$this->analyses->contains($analysis)) {
            $this->analyses->add($analysis);
            $analysis->setProduit($this);
        }

        return $this;
    }

    public function removeAnalysis(Analyse $analysis): self
    {
        if ($this->analyses->removeElement($analysis)) {
            // set the owning side to null (unless already changed)
            if ($analysis->getProduit() === $this) {
                $analysis->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EtatDesLieux>
     */
    public function getEtatDesLieuxes(): Collection
    {
        return $this->etatDesLieuxes;
    }

    public function addEtatDesLieux(EtatDesLieux $etatDesLieux): self
    {
        if (!$this->etatDesLieuxes->contains($etatDesLieux)) {
            $this->etatDesLieuxes->add($etatDesLieux);
            $etatDesLieux->setProduit($this);
        }

        return $this;
    }

    public function removeEtatDesLieux(EtatDesLieux $etatDesLieux): self
    {
        if ($this->etatDesLieuxes->removeElement($etatDesLieux)) {
            // set the owning side to null (unless already changed)
            if ($etatDesLieux->getProduit() === $this) {
                $etatDesLieux->setProduit(null);
            }
        }

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
            $adress->setProduit($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getProduit() === $this) {
                $adress->setProduit(null);
            }
        }

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getIdentification(): ?Identification
    {
        return $this->identification;
    }

    public function setIdentification(?Identification $identification): self
    {
        $this->identification = $identification;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }


    public function __toString() :string {
        return $this->name;
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
            $historique->setProduit($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getProduit() === $this) {
                $historique->setProduit(null);
            }
        }

        return $this;
    }

    public function getCarTechniques(): ?string
    {
        return $this->carTechniques;
    }

    public function setCarTechniques(?string $carTechniques): self
    {
        $this->carTechniques = $carTechniques;

        return $this;
    }

    public function getCarJuridiques(): ?string
    {
        return $this->carJuridiques;
    }

    public function setCarJuridiques(?string $carJuridiques): self
    {
        $this->carJuridiques = $carJuridiques;

        return $this;
    }

    public function getCarCommerciales(): ?string
    {
        return $this->carCommerciales;
    }

    public function setCarCommerciales(?string $carCommerciales): self
    {
        $this->carCommerciales = $carCommerciales;

        return $this;
    }

    public function getEnvironement(): ?string
    {
        return $this->environement;
    }

    public function setEnvironement(?string $environement): self
    {
        $this->environement = $environement;

        return $this;
    }

    
   

   

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

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
            $intervenant->setProduit($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): self
    {
        if ($this->intervenants->removeElement($intervenant)) {
            // set the owning side to null (unless already changed)
            if ($intervenant->getProduit() === $this) {
                $intervenant->setProduit(null);
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

    public function addMission(Mission $mission): static
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
            $mission->addProduit($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): static
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeProduit($this);
        }

        return $this;
    }

       
    
}
