<?php

namespace App\Controller\Admin;

use App\Entity\Wine;
use App\Entity\Color;
use App\Entity\Naming;
use App\Entity\Region;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Wine');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Les Vins', 'far fa-actor', Wine::class);
        yield MenuItem::linkToCrud('Couleurs', 'far fa-actor', Color::class);
        yield MenuItem::linkToCrud('Appellation', 'far fa-actor', Naming::class);
        yield MenuItem::linkToCrud('Région', 'far fa-actor', Region::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
