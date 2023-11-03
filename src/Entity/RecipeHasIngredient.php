<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Repository\RecipeHasIngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RecipeHasIngredientRepository::class)
 * @ApiResource(
 *      itemOperations={"get" ,"patch" ,"delete"})
 */
class RecipeHasIngredient
{

    use HasIdTrait;

    /**
     * @ORM\Column(type="float")
     * @Groups("get")
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("get")
     */
    private $optional;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="recipeHasIngredients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="recipeHasIngredients")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("get")
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity=IngredientGroup::class, inversedBy="recipeHasIngredients")
     * @Groups("get")
     */
    private $ingredientGroup;

    /**
     * @ORM\ManyToOne(targetEntity=Unit::class, inversedBy="recipeHasIngredients")
     * @ORM\JoinColumn(onDelete="SET NULL")
     * @Groups("get")
     */
    private $unit;

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function isOptional(): ?bool
    {
        return $this->optional;
    }

    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getIngredientGroup(): ?IngredientGroup
    {
        return $this->ingredientGroup;
    }

    public function setIngredientGroup(?IngredientGroup $ingredientGroup): self
    {
        $this->ingredientGroup = $ingredientGroup;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }
}
