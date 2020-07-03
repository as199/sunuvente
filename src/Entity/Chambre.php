<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numchambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="chambre")
     */
    private $matricules;

    public function __construct()
    {
        $this->matricules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumchambre(): ?string
    {
        return $this->numchambre;
    }

    public function setNumchambre(string $numchambre): self
    {
        $this->numchambre = $numchambre;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getMatricules(): Collection
    {
        return $this->matricules;
    }

    public function addMatricule(Etudiant $matricule): self
    {
        if (!$this->matricules->contains($matricule)) {
            $this->matricules[] = $matricule;
            $matricule->setChambre($this);
        }

        return $this;
    }

    public function removeMatricule(Etudiant $matricule): self
    {
        if ($this->matricules->contains($matricule)) {
            $this->matricules->removeElement($matricule);
            // set the owning side to null (unless already changed)
            if ($matricule->getChambre() === $this) {
                $matricule->setChambre(null);
            }
        }

        return $this;
    }
}
