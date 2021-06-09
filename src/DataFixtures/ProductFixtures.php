<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private $types = ['Déco', 'Canapé', 'Table de salle à manger', 'Chaise', 'Suspension', 'Table basse', 'Etagère', 'Tapis'];

    private $brands = ['Maisons du Monde', 'IKEA', 'La Redoute', 'Roche Bobois', 'Russel Hobbs'];

    private $age = ['- 2 ans', '2-6 ans', '+ 6 ans'];

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {

            $product = new Product();

            $product->setAppartment($this->getReference('appartment_1'));
            $product->setType($this->types[rand(0, 7)]);
            $product->setBrand($this->brands[rand(0, 4)]);
            $product->setCurrentPrice(rand(10, 1000));
            $product->setFormerPrice(rand(50, 1500));
            $product->setCurrentCondition('défauts mineurs non-visibles');
            $product->setAge($this->age[rand(0, 2)]);
            $product->setDescription('Vide-appartement témoin : rien n\'est à vendre !');
            $product->setPicture('https://izidore-production-bucket.s3.eu-west-3.amazonaws.com/media/cache/stuff_picture_XL/ea99a0b096c451486ffd3df31ef7d9b8.jpeg');

            $manager->persist($product);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppartmentFixtures::class,
        ];
    }
}
