<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("jeanvaljean@gmail.com");
        $user->setFirstName("Jean");
        $user->setLastName("Valjean");
        $user->setRoles("['ROLE_USER']");
        $manager->persist($user);

        $manager->flush();
    }
}
