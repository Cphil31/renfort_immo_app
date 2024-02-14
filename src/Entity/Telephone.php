<?php

namespace App\Entity;

use App\Repository\TelephoneRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelephoneRepository::class)]
class Telephone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;


    #[ORM\ManyToOne(inversedBy: 'telephones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutTelephone $statut = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observation = null;

    #[ORM\ManyToOne(inversedBy: 'telephones')]
    private ?Entreprise $entreprise = null;

    #[ORM\ManyToOne(inversedBy: 'telephones')]
    private ?Contact $contact = null;


   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

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

    public function getStatut(): ?StatutTelephone
    {
        return $this->statut;
    }

    public function setStatut(?StatutTelephone $statut): self
    {
        $this->statut = $statut;

        return $this;
    }


    public function __toString() :string {
        return $this->number;
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

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    


 
}
