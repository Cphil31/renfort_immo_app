<?php

namespace App\Entity;

use App\Repository\EtatDesLieuxRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtatDesLieuxRepository::class)]
class EtatDesLieux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'etatDesLieuxes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutEtatDesLieux $statut = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observation = null;

    #[ORM\ManyToOne(inversedBy: 'etatDesLieuxes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?StatutEtatDesLieux
    {
        return $this->statut;
    }

    public function setStatut(?StatutEtatDesLieux $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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
