<?php

namespace App\Controller\Admin;

use App\Entity\Appointment;
use App\Entity\Session;
use App\Entity\User;
use App\Entity\CauseType;
use App\Entity\Testimonial;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(AppointmentCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Beya Musicothérapie');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Dashboard', 'fa fa-tools');
        yield MenuItem::linkToCrud('Rendez-vous', 'fas fa-calendar-check', Appointment::class);
        yield MenuItem::linkToCrud('Raisons de prendre un rendez-vous', 'fas fa-question', CauseType::class);
        yield MenuItem::linkToCrud('Ateliers', 'fas fa-home', Session::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Témoignages', 'fas fa-paragraph', Testimonial::class);
    }
}
