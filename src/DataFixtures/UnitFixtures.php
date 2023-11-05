<?php

namespace App\DataFixtures;

use App\Entity\Unit;
use Doctrine\Persistence\ObjectManager;

class UnitFixtures extends AbstractFixtures
{
    public function load(ObjectManager $manager): void
    {
        $units = [
            'gramme' => 'grammes',
            'milligramme' => 'milligrammes',
            'kg' => 'kg',
            'pincée' => 'pincées',
            'poignée' => 'poignées',
            'tasse' => 'tasses',
            'litre' => 'litres',
            'centilitre' => 'centilitres',
            'millilitre' => 'millilitres',
            'cuillère à soupe' => 'cuillères à soupe',
            'cuillère à café' => 'cuillères à café',
        ];

        $unit = new Unit();
        foreach ($units as $singular => $plural) {
            $unit->setSigular($singular)
                ->setPlural($plural);
            $manager->persist($unit);
        }

        $manager->flush();
    }
}
