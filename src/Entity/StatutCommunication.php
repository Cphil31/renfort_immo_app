<?php

namespace App\Entity;

use App\Repository\StatutCommunicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutCommunicationRepository::class)]
class StatutCommunication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'statut', targetEntity: Communication::class)]
    private Collection $communications;

    public function __construct()
    {
        $this->communications = new ArrayCollection();
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
     * @return Collection<int, Communication>
     */
    public function getCommunications(): Collection
    {
        return $this->communications;
    }

    public function addCommunication(Communication $communication): self
    {
        if (!$this->communications->contains($communication)) {
            $this->communications->add($communication);
            $communication->setStatut($this);
        }

        return $this;
    }

    public function removeCommunication(Communication $communication): self
    {
        if ($this->communications->removeElement($communication)) {
            // set the owning side to null (unless already changed)
            if ($communication->getStatut() === $this) {
                $communication->setStatut(null);
            }
        }

        return $this;
    }
    public function __toString() :string {
        return $this->statut;
    }
}
