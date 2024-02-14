<?php

namespace App\Entity;

use App\Repository\IntervenantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IntervenantRepository::class)]
class Intervenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToOne(inversedBy: 'intervenants')]
    private ?Tache $tache = null;

    #[ORM\ManyToOne(inversedBy: 'intervenants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutIntervenant $statut = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observation = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '2', nullable: true)]
    private ?string $cout = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $realisations = null;

    #[ORM\ManyToOne(inversedBy: 'intervenants')]
    private ?Entreprise $entreprise = null;

    #[ORM\ManyToOne(inversedBy: 'intervenants')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Contact $contact = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column]
    #[ORM\JoinColumn(nullable: true)]
    private ?bool $payer = null;

    #[ORM\ManyToOne(inversedBy: 'intervenants')]
    private ?Produit $produit = null;

  

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTache(): ?Tache
    {
        return $this->tache;
    }

    public function setTache(?Tache $tache): self
    {
        $this->tache = $tache;

        return $this;
    }

    public function getStatut(): ?StatutIntervenant
    {
        return $this->statut;
    }

    public function setStatut(?StatutIntervenant $statut): self
    {
        $this->statut = $statut;

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

    public function getCout(): ?string
    {
        return $this->cout;
    }

    public function setCout(?string $cout): self
    {
        $this->cout = $cout;

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

    public function getRealisations(): ?string
    {
        return $this->realisations;
    }

    public function setRealisations(?string $realisations): self
    {
        $this->realisations = $realisations;

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

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(?\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function isPayer(): ?bool
    {
        return $this->payer;
    }

    public function setPayer(bool $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

   
 
    
}
