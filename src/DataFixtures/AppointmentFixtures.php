<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Appointment;
use App\Entity\AppointmentType;
use App\Entity\CauseType;
use App\Entity\Session;
use App\Entity\State;
use Faker;

class AppointmentFixtures extends Fixture
{
    private $availableState;
    private $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Faker\Factory::create('fr_FR');

        $this->loadCausesAndStates($manager);
        $this->loadAppointments($manager);
        $this->loadSessions($manager);

        $manager->flush();
    }

    public function loadCausesAndStates(ObjectManager $manager) {
        for($i = 1; $i <=3; $i++) {
            $causeType = new CauseType();
            $causeType->setNameType("Raison type n°. $i");
            $causeType->setDescription("Description type n°. $i");
            $manager->persist($causeType);
        }

        $availableState = new State();
        $availableState->setStateName("Disponible");
        $manager->persist($availableState);

        $this->availableState = $availableState;

        $unavailableState = new State();
        $unavailableState->setStateName("Indisponible");
        $manager->persist($unavailableState);
    }

    public function loadAppointments(ObjectManager $manager) {
        $individualApp = new AppointmentType();
        $individualApp->setTypeName("Rendez-vous individuel");
        $manager->persist($individualApp);

        $groupApp = new AppointmentType();
        $groupApp->setTypeName("Atelier groupé");
        $manager->persist($groupApp);

        for($i = 1; $i <=12; $i++) {
            $fakeApp = new Appointment();
            
            if($i % 2 == 0) $fakeApp->setType($individualApp);
            else $fakeApp->setType($groupApp);

            $fakeApp->setState($this->availableState);
            $fakeApp->setCompleteCause("");
            $fakeApp->setDate($this->faker->dateTimeBetween('+10 days', '+100 days'));
            $manager->persist($fakeApp);
        }
    }

    public function loadSessions(ObjectManager $manager) {
        for($i = 1; $i <=6; $i++) {
            $fakeSession = new Session();
            $fakeSession->setTitle("Fausse session n°" . $i);
            $fakeSession->setState($this->availableState);
            $fakeSession->setDescription("Session découverte");
            $fakeSession->setLink("");

            $beginsAt = $this->faker->dateTimeBetween('+10 days', '+100 days');
            $fakeSession->setBeginsAt($beginsAt);
            $fakeSession->setEndsAt($this->faker->dateTimeBetween($beginsAt, $beginsAt->format('Y-m-d H:i:s').' +2 hours'));
            $manager->persist($fakeSession);
        }
    }
}
