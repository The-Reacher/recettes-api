<?php

namespace App\Entity;

use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @ApiResource(
 *      itemOperations={"get" ,"patch" ,"delete"})
 */
class Tag {

    use HasIdTrait;
    use HasNameTrait;
    use HasDescriptionTrait;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("get")
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity=Tag::class, inversedBy="children")
     * @ORM\JoinColumn(onDelete="SET NULL")
     * @Groups("get")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Tag::class, mappedBy="parent")
     * @Groups("get")
     */
    private $children;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class, inversedBy="tags")
     */
    private $recipes;

    public function __construct() {
        $this->children = new ArrayCollection();
        $this->recipes = new ArrayCollection();
    }

    public function isMenu(): ?bool {
        return $this->menu;
    }

    public function setMenu(bool $menu): self {
        $this->menu = $menu;

        return $this;
    }

    public function getParent(): ?self {
        return $this->parent;
    }

    public function setParent(?self $parent): self {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection {
        return $this->children;
    }

    public function addChild(self $child): self {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        $this->recipes->removeElement($recipe);

        return $this;
    }
}
