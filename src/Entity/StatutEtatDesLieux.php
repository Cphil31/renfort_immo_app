<?php

namespace App\Entity;

use App\Repository\StatutEtatDesLieuxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutEtatDesLieuxRepository::class)]
class StatutEtatDesLieux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'statut', targetEntity: EtatDesLieux::class)]
    private Collection $etatDesLieuxes;

    public function __construct()
    {
        $this->etatDesLieuxes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, EtatDesLieux>
     */
    public function getEtatDesLieuxes(): Collection
    {
        return $this->etatDesLieuxes;
    }

    public function addEtatDesLieux(EtatDesLieux $etatDesLieux): self
    {
        if (!$this->etatDesLieuxes->contains($etatDesLieux)) {
            $this->etatDesLieuxes->add($etatDesLieux);
            $etatDesLieux->setStatut($this);
        }

        return $this;
    }

    public function removeEtatDesLieux(EtatDesLieux $etatDesLieux): self
    {
        if ($this->etatDesLieuxes->removeElement($etatDesLieux)) {
            // set the owning side to null (unless already changed)
            if ($etatDesLieux->getStatut() === $this) {
                $etatDesLieux->setStatut(null);
            }
        }

        return $this;
    }

    public function __toString() :string {
        return $this->statut;
    }


}
