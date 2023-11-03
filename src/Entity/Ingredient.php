<?php

namespace App\Entity;

use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\HasTimestampTrait;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 * @ApiResource(
 *      itemOperations={"get" ,"patch" ,"delete"})
 */
class Ingredient
{
    use HasIdTrait;
    use HasNameTrait;
    use HasDescriptionTrait;
    use HasTimestampTrait;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("get")
     */
    private $vegan;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("get")
     */
    private $vegetarian;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("get")
     */
    private $dairyFree;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("get")
     */
    private $glutenFree;

    /**
     * @ORM\OneToMany(targetEntity=RecipeHasIngredient::class, mappedBy="ingredient", orphanRemoval=true)
     */
    private $recipeHasIngredients;

    public function __construct()
    {
        $this->recipeHasIngredients = new ArrayCollection();
    }

    public function isVegan(): ?bool
    {
        return $this->vegan;
    }

    public function setVegan(bool $vegan): self
    {
        $this->vegan = $vegan;

        return $this;
    }

    public function isVegetarian(): ?bool
    {
        return $this->vegetarian;
    }

    public function setVegetarian(bool $vegetarian): self
    {
        $this->vegetarian = $vegetarian;

        return $this;
    }

    public function isDairyFree(): ?bool
    {
        return $this->dairyFree;
    }

    public function setDairyFree(bool $dairyFree): self
    {
        $this->dairyFree = $dairyFree;

        return $this;
    }

    public function isGlutenFree(): ?bool
    {
        return $this->glutenFree;
    }

    public function setGlutenFree(bool $glutenFree): self
    {
        $this->glutenFree = $glutenFree;

        return $this;
    }

    /**
     * @return Collection<int, RecipeHasIngredient>
     */
    public function getRecipeHasIngredients(): Collection
    {
        return $this->recipeHasIngredients;
    }

    public function addRecipeHasIngredient(RecipeHasIngredient $recipeHasIngredient): self
    {
        if (!$this->recipeHasIngredients->contains($recipeHasIngredient)) {
            $this->recipeHasIngredients[] = $recipeHasIngredient;
            $recipeHasIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeRecipeHasIngredient(RecipeHasIngredient $recipeHasIngredient): self
    {
        if ($this->recipeHasIngredients->removeElement($recipeHasIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeHasIngredient->getIngredient() === $this) {
                $recipeHasIngredient->setIngredient(null);
            }
        }

        return $this;
    }
}