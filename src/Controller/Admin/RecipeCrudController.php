<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use App\Form\ImageType;
use App\Form\RecipeHasIngredientType;
use App\Form\RecipeHasSourceType;
use App\Form\StepType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            BooleanField::new('draft'),
            IntegerField::new('cooking'),
            IntegerField::new('break'),
            IntegerField::new('preparation'),
            CollectionField::new('steps')
                ->setEntryType(StepType::class)

                ->allowAdd(),
            CollectionField::new('images')
                ->setEntryType(ImageType::class)
                ->allowDelete()
                ->allowAdd(),
            CollectionField::new('recipeHasIngredients')
                ->setEntryType(RecipeHasIngredientType::class)
                ->allowDelete()
                ->allowAdd(),
            CollectionField::new('recipeHasSources')
                ->setEntryType(RecipeHasSourceType::class)
                ->allowDelete()
                ->allowAdd(),
            AssociationField::new('tags')
                // Cette option est nécessaire pour que nos adders et removers soient appelés
                // lors de l'enregistrement du formulaire (https://symfony.com/doc/current/reference/forms/types/entity.html#by-reference).
                // Sans cela, les suppressions de liens avec des tags sont juste ignorés.
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
}
