<?php

namespace App\Entity;

use App\Repository\MailRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailRepository::class)]
class Mail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'mails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutMail $statut = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'mails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contact $contact = null;

    #[ORM\ManyToOne(inversedBy: 'mails')]
    private ?Entreprise $entreprise = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $objet = null;

    
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'mails')]
    private ?mission $mission = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?StatutMail
    {
        return $this->statut;
    }

    public function setStatut(?StatutMail $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(?string $objet): self
    {
        $this->objet = $objet;

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

    public function getMission(): ?mission
    {
        return $this->mission;
    }

    public function setMission(?mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    

   
}
