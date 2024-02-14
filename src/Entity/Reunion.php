<?php

namespace App\Entity;

use App\Repository\ReunionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReunionRepository::class)]
class Reunion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $objet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'reunions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tache $tache = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $coutLocationSalle = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $CoutLocationMateriel = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $CoutRestauration = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $coutCollation = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $forfaitHoraire = null;

    #[ORM\Column]
    private ?bool $payer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(?string $objet): self
    {
        $this->objet = $objet;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
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

    public function getCoutLocationSalle(): ?string
    {
        return $this->coutLocationSalle;
    }

    public function setCoutLocationSalle(?string $coutLocationSalle): self
    {
        $this->coutLocationSalle = $coutLocationSalle;

        return $this;
    }

    public function getCoutLocationMateriel(): ?string
    {
        return $this->CoutLocationMateriel;
    }

    public function setCoutLocationMateriel(?string $CoutLocationMateriel): self
    {
        $this->CoutLocationMateriel = $CoutLocationMateriel;

        return $this;
    }

    public function getCoutRestauration(): ?string
    {
        return $this->CoutRestauration;
    }

    public function setCoutRestauration(?string $CoutRestauration): self
    {
        $this->CoutRestauration = $CoutRestauration;

        return $this;
    }

    public function getCoutCollation(): ?string
    {
        return $this->coutCollation;
    }

    public function setCoutCollation(?string $coutCollation): self
    {
        $this->coutCollation = $coutCollation;

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

    public function getForfaitHoraire(): ?string
    {
        return $this->forfaitHoraire;
    }

    public function setForfaitHoraire(?string $forfaitHoraire): self
    {
        $this->forfaitHoraire = $forfaitHoraire;

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
