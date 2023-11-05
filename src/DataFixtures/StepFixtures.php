<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use App\Entity\Step;
use App\Repository\RecipeRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StepFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    /**
     * @var RecipeRepository
     */
    protected $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
        parent::__construct();
    }

    public function load(ObjectManager $manager): void
    {
        $recipes = $this->recipeRepository->findAll();
        for ($i = 0; $i < 250; ++$i) {
            $step = new Step();
            /** @var Recipe $recipe */
            $recipe = $this->faker->randomElement($recipes);
            $step
                ->setContent($this->faker->realText())
                ->setPriority($this->faker->randomDigitNotNull())
                ->setRecipe($recipe);
            $manager->persist($step);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            // syntaxe FQCN ("Fully Qualified Class Name")
            RecipeFixtures::class,
        ];
    }
}
