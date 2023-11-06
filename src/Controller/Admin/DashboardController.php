<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Ingredient;
use App\Entity\IngredientGroup;
use App\Entity\Recipe;
use App\Entity\RecipeHasIngredient;
use App\Entity\RecipeHasSource;
use App\Entity\Source;
use App\Entity\Step;
use App\Entity\Tag;
use App\Entity\Unit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->renderContentMaximized()
            ->renderSidebarMinimized()
            ->setTitle('Dashboard Recipes');
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->renderContentMaximized()
            ->showEntityActionsInlined();
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/Dashboard/admin.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Recipes', 'fas fa-book', Recipe::class);
        yield MenuItem::section('DATAS');
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);
        yield MenuItem::linkToCrud('Ingredients', 'fas fa-shopping-basket', Ingredient::class);
        yield MenuItem::linkToCrud('Sources', 'fas fa-external-link-alt', Source::class);
        yield MenuItem::linkToCrud('Units', 'fas fa-weight-hanging', Unit::class);
        yield MenuItem::section('SUBDATAS');
        yield MenuItem::linkToCrud('Steps', 'fas fa-sort-numeric-up', Step::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-images', Image::class);
        yield MenuItem::linkToCrud('Ingredient groups', 'fas fa-boxes', IngredientGroup::class);
        yield MenuItem::linkToCrud('Ingredient recipes', 'fas fa-boxes', RecipeHasIngredient::class);
        yield MenuItem::linkToCrud('Sources recipes', 'fas fa-external-link-alt', RecipeHasSource::class);
    }
}
