<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
    $this->encoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName("Jean");
        $user->setLastName("Valjean");
        $user->setEmail("jeanvaljean@email.com");
        $hash = $this->encoder->encodePassword($user, "VictorHugo");
        $user->setPassword($hash);
        $user->setVerified(true);

        $manager->persist($user);
        $manager->flush();
    }
}
