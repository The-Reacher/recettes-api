<?php

namespace App\Controller\Admin;

use App\Entity\IngredientGroup;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IngredientGroupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return IngredientGroup::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            NumberField::new('priority'),
            AssociationField::new('recipeHasIngredients'),
        ];
    }
}
