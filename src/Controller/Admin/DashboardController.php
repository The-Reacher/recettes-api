<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Ingredient;
use App\Entity\IngredientGroup;
use App\Entity\Recipe;
use App\Entity\Source;
use App\Entity\Tag;
use App\Entity\Unit;
use App\Entity\User;
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
     * @Route("/admin", name="admin_dashboard_index")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // permet de rendre la vue dhashboard sur toute la largeur
            ->renderContentMaximized()
            // barre des menus à gauche
            ->renderSidebarMinimized()
            // Titre du dashboard
            ->setTitle('Dashboard Recipes');
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            // body du dashboard sur toute la largeur
            ->renderContentMaximized()
            // permet d'afficher les boutons (supp/modif) de chaque ligne au lieu d'afficher en dropdown
            ->showEntityActionsInlined()
            // afficher les lignes des tableaux par ordre descendant d'id
            ->setDefaultSort([
                'id' => 'DESC',
            ]);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/Dashboard/admin.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Recipes', 'fas fa-book', Recipe::class);
        // Liens vers les crud que j'ai crée pour chaque entité
        yield MenuItem::section('DATAS');

        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Sources', 'fas fa-external-link-alt', Source::class);
        yield MenuItem::linkToCrud('Units', 'fas fa-weight-hanging', Unit::class);
        yield MenuItem::linkToCrud('Ingredients', 'fas fa-shopping-basket', Ingredient::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);

        yield MenuItem::section('SUBDATAS');

        yield MenuItem::linkToCrud('Images', 'fas fa-images', Image::class);
        yield MenuItem::linkToCrud('Ingredient groups', 'fas fa-boxes', IngredientGroup::class);
        }
}
