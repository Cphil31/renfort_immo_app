<?php

namespace App\Entity;

use App\Repository\RestaurationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurationRepository::class)]
class Restauration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'restaurations')]
    private ?Tache $tache = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0', nullable: true)]
    private ?string $coutRepasPersonnel = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $coutRepasClients = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $forfait = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $etablissement = null;

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

    public function getCoutRepasPersonnel(): ?string
    {
        return $this->coutRepasPersonnel;
    }

    public function setCoutRepasPersonnel(?string $coutRepasPersonnel): self
    {
        $this->coutRepasPersonnel = $coutRepasPersonnel;

        return $this;
    }

    public function getCoutRepasClients(): ?string
    {
        return $this->coutRepasClients;
    }

    public function setCoutRepasClients(?string $coutRepasClients): self
    {
        $this->coutRepasClients = $coutRepasClients;

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

    public function getForfait(): ?string
    {
        return $this->forfait;
    }

    public function setForfait(?string $forfait): self
    {
        $this->forfait = $forfait;

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

    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }

    public function setEtablissement(?string $etablissement): self
    {
        $this->etablissement = $etablissement;

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
