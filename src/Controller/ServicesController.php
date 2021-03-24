<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TestimonialRepository;
use App\Repository\AppointmentRepository;
use App\Repository\SessionRepository;
use App\Form\ServiceType;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     */
    public function index(TestimonialRepository $testimonialRepository, AppointmentRepository $appointmentRepo, SessionRepository $sessionRepo): Response
    {
        $availableAppointments = $appointmentRepo->findFirstAppointments($limit = 8, $available = true);
        $availableSessions = $sessionRepo->findFirstSessions($limit = 8, $available = true);

        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
            'appointments' => $availableAppointments,
            'sessions' => $availableSessions,
            'testimonials' => $testimonialRepository->findAll(),
        ]);
    }

    /**
     * @Route("/confirm/{type}/{id}", name="confirmBooking")
     */
    public function confirm(string $type, int $id, Request $request): Response
    {
        $form = $this->createForm(ServiceType::class);

        $form->handleRequest($request);

        $maxParticipants = 5;

        if($type == "appointment") {
            $title = "Confirmer réservation d'un rendez-vous";
        }

        else {
            $title = "Confirmer réservation d'une session en ligne";
        }

        return $this->render('services/confirm.html.twig', [
            'controller_name' => 'ServicesController',
            'title' => $title,
            'max_participants' => $maxParticipants,
            'cause_message' => 'Décrivez plus en détail quelles raisons vous amènent à considérer la musicothérapie',
            'form' => $form->createView()
        ]);
    }
}
