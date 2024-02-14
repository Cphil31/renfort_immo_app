<?php

namespace App\Entity;

use App\Repository\StatutTelephoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutTelephoneRepository::class)]
class StatutTelephone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\OneToMany(mappedBy: 'statut', targetEntity: Telephone::class)]
    private Collection $telephones;

    public function __construct()
    {
        $this->telephones = new ArrayCollection();
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
     * @return Collection<int, Telephone>
     */
    public function getTelephones(): Collection
    {
        return $this->telephones;
    }

    public function addTelephone(Telephone $telephone): self
    {
        if (!$this->telephones->contains($telephone)) {
            $this->telephones->add($telephone);
            $telephone->setStatut($this);
        }

        return $this;
    }

    public function removeTelephone(Telephone $telephone): self
    {
        if ($this->telephones->removeElement($telephone)) {
            // set the owning side to null (unless already changed)
            if ($telephone->getStatut() === $this) {
                $telephone->setStatut(null);
            }
        }

        return $this;
    }

    public function __toString() :string {
        return $this->statut;
    }
}
