<?php

namespace App\Entity;

use App\Repository\StatutDeplacementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutDeplacementRepository::class)]
class StatutDeplacement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'statut', targetEntity: Deplacement::class)]
    private Collection $deplacements;


    public function __construct()
    {
        $this->deplacements = new ArrayCollection();
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

    

    
    public function __toString() :string {
        return $this->statut;
    }

    /**
     * @return Collection<int, Deplacement>
     */
    public function getDeplacements(): Collection
    {
        return $this->deplacements;
    }

    public function addDeplacement(Deplacement $deplacement): self
    {
        if (!$this->deplacements->contains($deplacement)) {
            $this->deplacements->add($deplacement);
            $deplacement->setStatut($this);
        }

        return $this;
    }

    public function removeDeplacement(Deplacement $deplacement): self
    {
        if ($this->deplacements->removeElement($deplacement)) {
            // set the owning side to null (unless already changed)
            if ($deplacement->getStatut() === $this) {
                $deplacement->setStatut(null);
            }
        }

        return $this;
    }
}
