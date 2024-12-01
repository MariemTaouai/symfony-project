<?php

namespace App\Controller\Admin;

use App\Entity\Student;
use App\Entity\Borrowing;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]

    public function index2(): Response {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(BorrowingCrudController::class)->generateUrl();
        return $this->redirect($url); //return parent::index();
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('<img src="/img/Book.png" class="img-fluid d-block mx-auto" style="max-width:100px; width:100%;"><h2 class="mt-3 fw-bold text-white text-center">Librarian</h2>')
        ->renderContentMaximized(); 
    }   

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Student', 'fas fa-chalkboard-teacher', Student::class);
        yield MenuItem::linkToCrud('Borrowing', 'fas fa-book-reader', Borrowing::class); 

    }

    
}
