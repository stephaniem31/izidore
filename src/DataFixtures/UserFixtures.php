<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstName('Emma');
        $user->setLastName('Izi');
        $user->setEmail('emma@izidore.com');
        $user->setProfilePicture('\build\images\pp.png');

        $manager->persist($user);
        $this->addReference('user_1', $user);
        $manager->flush();
    }
}
