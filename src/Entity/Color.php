<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColorRepository::class)
 */
class Color
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Wine::class, mappedBy="color")
     */
    private $wine;

    public function __toString() 
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->wine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Wine[]
     */
    public function getWine(): Collection
    {
        return $this->wine;
    }

    public function addWine(Wine $wine): self
    {
        if (!$this->wine->contains($wine)) {
            $this->wine[] = $wine;
            $wine->setColor($this);
        }

        return $this;
    }

    public function removeWine(Wine $wine): self
    {
        if ($this->wine->removeElement($wine)) {
            // set the owning side to null (unless already changed)
            if ($wine->getColor() === $this) {
                $wine->setColor(null);
            }
        }

        return $this;
    }
}
