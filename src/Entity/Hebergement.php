<?php

namespace App\Entity;

use App\Repository\HebergementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HebergementRepository::class)]
class Hebergement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'hebergements')]
    private ?Tache $tache = null;

    #[ORM\Column]
    private ?int $nuit = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $coutNuitUnitaire = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $lieu = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?bool $payer = null;

   

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

    public function getNuit(): ?int
    {
        return $this->nuit;
    }

    public function setNuit(int $nuit): self
    {
        $this->nuit = $nuit;

        return $this;
    }

    public function getCoutNuitUnitaire(): ?string
    {
        return $this->coutNuitUnitaire;
    }

    public function setCoutNuitUnitaire(string $coutNuitUnitaire): self
    {
        $this->coutNuitUnitaire = $coutNuitUnitaire;

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

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

   
}
