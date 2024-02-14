<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?Tache $tache = null;

    #[ORM\Column(length: 500)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $coutAchatDocument = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $coutDocumentCommande = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $coutDocumentProduit = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCoutAchatDocument(): ?string
    {
        return $this->coutAchatDocument;
    }

    public function setCoutAchatDocument(?string $coutAchatDocument): self
    {
        $this->coutAchatDocument = $coutAchatDocument;

        return $this;
    }

    public function getCoutDocumentCommande(): ?string
    {
        return $this->coutDocumentCommande;
    }

    public function setCoutDocumentCommande(?string $coutDocumentCommande): self
    {
        $this->coutDocumentCommande = $coutDocumentCommande;

        return $this;
    }

    public function getCoutDocumentProduit(): ?string
    {
        return $this->coutDocumentProduit;
    }

    public function setCoutDocumentProduit(?string $coutDocumentProduit): self
    {
        $this->coutDocumentProduit = $coutDocumentProduit;

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
