<?php

namespace App\Entity;

use App\Repository\ProblemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProblemeRepository::class)]
class Probleme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    

    #[ORM\ManyToOne(inversedBy: 'problemes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutProbleme $statut = null;

    #[ORM\OneToMany(mappedBy: 'probleme', targetEntity: Tache::class ,orphanRemoval:true)]
    private Collection $taches;


    #[ORM\ManyToOne(inversedBy: 'problemes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mission $mission = null;

    #[ORM\ManyToOne(inversedBy: 'problemes')]
    private ?Classe $classe = null;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getStatut(): ?StatutProbleme
    {
        return $this->statut;
    }

    public function setStatut(?StatutProbleme $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches->add($tach);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getProbleme() === $this) {
                $tach->setProbleme(null);
            }
        }

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

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }
}
