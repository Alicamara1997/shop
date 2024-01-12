<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Bootle::class, orphanRemoval: true)]
    private Collection $bootles;

    public function __construct()
    {
        $this->bootles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Bootle>
     */
    public function getBootles(): Collection
    {
        return $this->bootles;
    }

    public function addBootle(Bootle $bootle): static
    {
        if (!$this->bootles->contains($bootle)) {
            $this->bootles->add($bootle);
            $bootle->setRegion($this);
        }

        return $this;
    }

    public function removeBootle(Bootle $bootle): static
    {
        if ($this->bootles->removeElement($bootle)) {
            // set the owning side to null (unless already changed)
            if ($bootle->getRegion() === $this) {
                $bootle->setRegion(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return$this->getName();
    }
}
