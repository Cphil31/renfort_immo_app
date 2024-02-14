<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueRepository::class)]
class Historique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $historique = null;

    #[ORM\ManyToOne(inversedBy: 'historiques')]
    private ?Contact $contact = null;

    #[ORM\ManyToOne(inversedBy: 'historiques')]
    private ?Entreprise $entreprise = null;

    #[ORM\ManyToOne(inversedBy: 'historiques')]
    private ?Produit $produit = null;

    #[ORM\Column(length: 500)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHistorique(): ?string
    {
        return $this->historique;
    }

    public function setHistorique(?string $historique): self
    {
        $this->historique = $historique;

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

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

 


}
