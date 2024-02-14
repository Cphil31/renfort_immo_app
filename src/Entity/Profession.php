<?php

namespace App\Entity;

use App\Entity\Entreprise;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfessionRepository;

#[ORM\Entity(repositoryClass: ProfessionRepository::class)]
class Profession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $profession = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $poste = null;

    #[ORM\ManyToOne(inversedBy: 'professions')]
    private ?Entreprise $entreprise = null;

    #[ORM\ManyToOne(inversedBy: 'professions')]
    private ?Contact $contact = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getEntreprise(): ?entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?entreprise $entreprise): self
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

   
}
