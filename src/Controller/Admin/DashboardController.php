<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController {
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard {
        return Dashboard::new()
            ->renderContentMaximized()
            ->setTitle('Dashboard Recipes');
    }

    public function configureCrud(): Crud {
        return parent::configureCrud()
            ->renderContentMaximized()
            ->showEntityActionsInlined();
    }

    public function configureAssets(): Assets {
        return Assets::new()->addCssFile('css/Dashboard/admin.css');
    }

    public function configureMenuItems(): iterable {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class);
    }
}
