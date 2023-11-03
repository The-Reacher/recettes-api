<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Repository\RecipeHasSourceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RecipeHasSourceRepository::class)
 */
class RecipeHasSource
{

    use HasIdTrait;

    /**
     * @ORM\Column(type="text")
     * @Groups("get")
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="recipeHasSources")
     * @Groups("get") 
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity=Source::class, inversedBy="recipeHasSources")
     * @Groups("get") 
     */
    private $source;

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }
}