<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TestimonialRepository;
use App\Repository\AppointmentRepository;
use App\Repository\SessionRepository;
use App\Repository\StateRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AppointmentType;
use App\Form\SessionType;

class ServicesController extends AbstractController
{
    private $appointmentRepo;
    private $sessionRepo;
    private $stateRepo;

    private $manager;

    const APP_TYPES = ["appointment" => "appointment", "session" => "group-session"];

    public function __construct(AppointmentRepository $appointmentRepo, SessionRepository $sessionRepo, StateRepository $stateRepo, EntityManagerInterface $manager) {
        $this->appointmentRepo = $appointmentRepo;
        $this->sessionRepo = $sessionRepo;
        $this->stateRepo = $stateRepo;

        $this->manager = $manager;
    }

    /**
     * @Route("/services", name="services")
     */
    public function index(TestimonialRepository $testimonialRepository): Response
    {
        $availableAppointments = $this->appointmentRepo->findFirstAppointments($limit = 8, $available = true);
        $availableSessions = $this->sessionRepo->findFirstSessions($limit = 8, $available = true);

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
        if($type == self::APP_TYPES["appointment"]) $form = $this->createForm(AppointmentType::class);
        else if($type == self::APP_TYPES["session"]) $form = $this->createForm(SessionType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if($this->validateBooking($form->getData(), $type, $id)) return $this->redirectToRoute("home");
        }

        if($type == self::APP_TYPES["appointment"]) {
            $appointment = $this->appointmentRepo->findOneById($id);
            $title = "Confirmer réservation d'un rendez-vous le " . $appointment->getDate()->format('d/m/Y') . " à " . $appointment->getDate()->format("H:i");
        }

        else {
            $appointment = $this->sessionRepo->findOneById($id);
            $title = "Confirmer réservation sur la session en ligne " . $appointment->getTitle() . " le " 
                . $appointment->getBeginsAt()->format('d/m/Y') . " à " . $appointment->getBeginsAt()->format("H:i");
        }

        return $this->render('services/confirm.html.twig', [
            'controller_name' => 'ServicesController',
            'title' => $title,
            'cause_message' => 'Décrivez plus en détail quelles raisons vous amènent à considérer la musicothérapie',
            'form' => $form->createView(),
            'type' => $type,
        ]);
    }

    public function validateBooking(array $formData, string $type, int $id) : bool {
        if($type == self::APP_TYPES["appointment"]) {
            $appointment = $this->appointmentRepo->findOneById($id);

            $appointment->setUser($this->getUser());
            $appointment->setParticipants($formData["participants"]);
            $appointment->setCauseType($formData["causeType"]);
            $appointment->setCompleteCause($formData["completeCause"]);
            $appointment->setState($this->stateRepo->findOneByAvailability(false));

            $this->manager->persist($appointment);
            $this->manager->flush();

            $this->addFlash("success", "Votre rendez-vous a bien été pris, vous allez recevoir une confirmation par e-mail !");

            return true;
        }

        else if($type == self::APP_TYPES["session"]) {
            $session = $this->sessionRepo->findOneById($id);

            $session->addParticipant($this->getUser());

            $this->manager->persist($session);
            $this->manager->flush();

            $this->addFlash("success", "Votre session en ligne a bien été payée et réservée, vous allez recevoir une confirmation par e-mail !");

            return true;
        }

        else return false;
    }
}
