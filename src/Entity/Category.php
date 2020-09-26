<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Gif::class, mappedBy="category", orphanRemoval=true)
     */
    private $gifs;

    public function __construct()
    {
        $this->gifs = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|Gif[]
     */
    public function getGifs(): Collection
    {
        return $this->gifs;
    }

    public function addGif(Gif $gif): self
    {
        if (!$this->gifs->contains($gif)) {
            $this->gifs[] = $gif;
            $gif->setCategory($this);
        }

        return $this;
    }

    public function removeGif(Gif $gif): self
    {
        if ($this->gifs->contains($gif)) {
            $this->gifs->removeElement($gif);
            // set the owning side to null (unless already changed)
            if ($gif->getCategory() === $this) {
                $gif->setCategory(null);
            }
        }

        return $this;
    }
}
