<?php

namespace App\DataFixtures;

use App\Entity\Appartment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppartmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $appartment = new Appartment();
        $appartment->setUser($this->getReference('user_1'));
        $appartment->setAddress('10 rue du Chat Malin');
        $appartment->setZipcode('15120');
        $appartment->setCity('Junhac');
        $appartment->setDescription('Vide-appartement témoin : rien n\'est à vendre !');
        $appartment->setObjectDown(true);
        $appartment->setPicture('https://izidore-production-bucket.s3.eu-west-3.amazonaws.com/media/cache/announce_cover_picture_XL/6f6c5f5ee0ce232670c4aa3e1b249514.jpeg');

        $manager->persist($appartment);
        $this->addReference('appartment_1', $appartment);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
