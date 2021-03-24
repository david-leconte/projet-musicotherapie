<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TestimonialRepository;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     */
    public function index(TestimonialRepository $testimonialRepository): Response
    {
        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
            'testimonials' => $testimonialRepository->findAll(),
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
