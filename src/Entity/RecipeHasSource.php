<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\HasIdTrait;
use App\Repository\RecipeHasSourceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RecipeHasSourceRepository::class)
 *
 * @ApiResource(
 *      collectionOperations={"get"},
 *
 *      itemOperations={"get",
 *                      "patch" = {"security"="is_granted('ROLE_ADMIN') or object.getRecipe().getUser() == user"},
 *                      "delete" = {"security"="is_granted('ROLE_ADMIN') or object.getRecipe().getUser() == user"},
 *                      "put" = {"security"="is_granted('ROLE_ADMIN') or object.getRecipe().getUser() == user"}
 *                      },
 *      normalizationContext={"groups"={"get"}})
 */
class RecipeHasSource
{
    use HasIdTrait;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups("get")
     */
    private string $url;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="recipeHasSources")
     *
     * @Groups("get")
     */
    private ?Recipe $recipe;

    /**
     * @ORM\ManyToOne(targetEntity=Source::class, inversedBy="recipeHasSources")
     *
     * @Groups("get")
     */
    private ?Source $source;

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

    public function __toString(): string
    {
        return $this->getRecipe().' - '.$this->getSource();
    }
}
