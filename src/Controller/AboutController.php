<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TestimonialRepository;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index(TestimonialRepository $testimonialRepository): Response
    {
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
            'testimonials' => $testimonialRepository->findAll(),
        ]);
    }
}
