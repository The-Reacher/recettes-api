<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Entity\Traits\HasPriorityTrait;
use App\Repository\IngredientGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientGroupRepository::class)
 *
 * @ApiResource(
 *      collectionOperations={"get"},
 *
 *      itemOperations={"get","patch" ,"delete", "put"},
 *      normalizationContext={"groups"={"get"}})
 */
class IngredientGroup
{
    use HasIdTrait;
    use HasNameTrait;
    use HasPriorityTrait;

    /**
     * @var Collection<int, RecipeHasIngredient>
     *
     * @ORM\OneToMany(targetEntity=RecipeHasIngredient::class, mappedBy="ingredientGroup")
     */
    private Collection $recipeHasIngredients;

    public function __construct()
    {
        $this->recipeHasIngredients = new ArrayCollection();
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
            $recipeHasIngredient->setIngredientGroup($this);
        }

        return $this;
    }

    public function removeRecipeHasIngredient(RecipeHasIngredient $recipeHasIngredient): self
    {
        if ($this->recipeHasIngredients->removeElement($recipeHasIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeHasIngredient->getIngredientGroup() === $this) {
                $recipeHasIngredient->setIngredientGroup(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName().' ('.$this->getId().')';
    }
}
