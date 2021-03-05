<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     */
    public function index(): Response
    {
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }

    /**
     * @Route("/confirm", name="confirmBooking")
     */
    public function confirm(): Response
    {
        return $this->render('services/confirm.html.twig', [
            'controller_name' => 'ServicesController',
        ]);
    }
}
