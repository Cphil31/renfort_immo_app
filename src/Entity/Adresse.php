<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutAdresse $statut = null;

    #[ORM\ManyToOne(inversedBy: 'adresses' )]
    #[ORM\JoinColumn(nullable: true)]
    private ?Contact $contact = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $rue = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $code_postal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $departement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pays = null;

    #[ORM\ManyToOne(inversedBy: 'adresses' )]
    #[ORM\JoinColumn(nullable: true)]
    private ?Produit $produit = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Entreprise $entreprise = null;

    #[ORM\Column]
    private ?bool $facturation = null;

    


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?StatutAdresse
    {
        return $this->statut;
    }

    public function setStatut(?StatutAdresse $statut): self
    {
        $this->statut = $statut;

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

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(?string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

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

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function isFacturation(): ?bool
    {
        return $this->facturation;
    }

    public function setFacturation(bool $facturation): self
    {
        $this->facturation = $facturation;

        return $this;
    }


    

   



}
