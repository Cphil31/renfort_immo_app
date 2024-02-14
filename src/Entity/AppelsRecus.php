<?php

namespace App\Entity;

use App\Repository\AppelsRecusRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppelsRecusRepository::class)]
class AppelsRecus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'appelsRecuses')]
    private ?Contact $contact = null;

    #[ORM\ManyToOne(inversedBy: 'appelsRecuses')]
    private ?Mission $mission = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $objet = null;

    #[ORM\Column(nullable: true)]
    private ?bool $appeller = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
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

    public function isAppeller(): ?bool
    {
        return $this->appeller;
    }

    public function setAppeller(?bool $appeller): self
    {
        $this->appeller = $appeller;

        return $this;
    }
}
