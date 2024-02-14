<?php

namespace App\Entity;

use App\Repository\DeplacementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeplacementRepository::class)]
class Deplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'deplacements')]
    private ?Tache $tache = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $lieu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $cout = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $coutPeage = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $coutCarburant = null;

    #[ORM\ManyToOne(inversedBy: 'deplacements')]
    private ?StatutDeplacement $statut = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observation = null;

    #[ORM\Column]
    private ?bool $payer = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0', nullable: true)]
    private ?string $kilometrage_depart = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0', nullable: true)]
    private ?string $kilometrage_arrive = null;

   

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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

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

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(?\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

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

    public function getCoutPeage(): ?string
    {
        return $this->coutPeage;
    }

    public function setCoutPeage(?string $coutPeage): self
    {
        $this->coutPeage = $coutPeage;

        return $this;
    }

    public function getCoutCarburant(): ?string
    {
        return $this->coutCarburant;
    }

    public function setCoutCarburant(?string $coutCarburant): self
    {
        $this->coutCarburant = $coutCarburant;

        return $this;
    }

    public function getStatut(): ?StatutDeplacement
    {
        return $this->statut;
    }

    public function setStatut(?StatutDeplacement $statut): self
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

    public function isPayer(): ?bool
    {
        return $this->payer;
    }

    public function setPayer(bool $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    public function getKilometrageDepart(): ?string
    {
        return $this->kilometrage_depart;
    }

    public function setKilometrageDepart(?string $kilometrage_depart): static
    {
        $this->kilometrage_depart = $kilometrage_depart;

        return $this;
    }

    public function getKilometrageArrive(): ?string
    {
        return $this->kilometrage_arrive;
    }

    public function setKilometrageArrive(?string $kilometrage_arrive): static
    {
        $this->kilometrage_arrive = $kilometrage_arrive;

        return $this;
    }

   
}
