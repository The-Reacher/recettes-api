<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecipeFixtures extends AbstractFixtures implements DependentFixtureInterface {

    public function load(ObjectManager $manager): void {

        for ($i = 0; $i < 50; ++$i) {
            $recipe = new Recipe();
            $recipe->setName($this->faker->name())
                ->setDescription($this->faker->realText(500))
                ->setDraft($this->faker->boolean(0.1))
                ->setPreparation($this->faker->optional(0.01)->numberBetween(5, 120))
                ->setCooking($this->faker->optional(0.05)->numberBetween(0, 120))
                ->setBreak($this->faker->optional(0.01)->numberBetween(0, 600));

            $manager->persist($recipe);
        }
        $manager->flush();
    }
    public function getDependencies() {
        return [
            //syntaxe FQCN ("Fully Qualified Class Name")
            TagFixtures::class
        ];
    }
}
