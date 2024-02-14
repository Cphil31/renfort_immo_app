<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $reference = null;

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: Devis::class, orphanRemoval: true)]
    private Collection $devis;

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: AppelsRecus::class, orphanRemoval: true)]
    private Collection $appelsRecuses;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $localisation = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $stade = null;

    
    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: Mail::class)]
    private Collection $mails;

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: Probleme::class)]
    private Collection $problemes;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    private ?Contact $contact = null;

    #[ORM\ManyToOne(inversedBy: 'missions')]
    private ?Entreprise $entreprise = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'missions')]
    private Collection $produit;

    

    public function __construct()
    {
        $this->devis = new ArrayCollection();
        $this->appelsRecuses = new ArrayCollection();
       
        $this->mails = new ArrayCollection();
        $this->problemes = new ArrayCollection();
        $this->produit = new ArrayCollection();
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
    
    public function __toString() :string {
        return $this->name;
    }

    /**
     * @return Collection<int, Devis>
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevi(Devis $devi): self
    {
        if (!$this->devis->contains($devi)) {
            $this->devis->add($devi);
            $devi->setMission($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->removeElement($devi)) {
            // set the owning side to null (unless already changed)
            if ($devi->getMission() === $this) {
                $devi->setMission(null);
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
            $appelsRecus->setMission($this);
        }

        return $this;
    }

    public function removeAppelsRecus(AppelsRecus $appelsRecus): self
    {
        if ($this->appelsRecuses->removeElement($appelsRecus)) {
            // set the owning side to null (unless already changed)
            if ($appelsRecus->getMission() === $this) {
                $appelsRecus->setMission(null);
            }
        }

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(?string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    
   
    public function getStade(): ?string
    {
        return $this->stade;
    }

    public function setStade(string $stade): self
    {
        $this->stade = $stade;

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
            $mail->setMission($this);
        }

        return $this;
    }

    public function removeMail(Mail $mail): self
    {
        if ($this->mails->removeElement($mail)) {
            // set the owning side to null (unless already changed)
            if ($mail->getMission() === $this) {
                $mail->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Probleme>
     */
    public function getProblemes(): Collection
    {
        return $this->problemes;
    }
    
    public function addProbleme(Probleme $probleme): self
    {
        if (!$this->problemes->contains($probleme)) {
            $this->problemes->add($probleme);
            $probleme->setMission($this);
        }

        return $this;
    }

    public function removeProbleme(Probleme $probleme): self
    {
        if ($this->problemes->removeElement($probleme)) {
            // set the owning side to null (unless already changed)
            if ($probleme->getMission() === $this) {
                $probleme->setMission(null);
            }
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        $this->produit->removeElement($produit);

        return $this;
    }

    

}
