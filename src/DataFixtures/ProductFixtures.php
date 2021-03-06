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
        for ($i = 1; $i <= 9; $i++) {

            $product = new Product();
            $index = rand(0, count($this->types) - 1);
            $currentPrice = rand(10, 1000);


            $product->setAppartment($this->getReference('appartment_1'));
            $product->setType($this->types[$index]);
            $product->setBrand($this->brands[rand(0, count($this->brands) - 1)]);
            $product->setCurrentPrice($currentPrice);
            $product->setFormerPrice(rand(($currentPrice + 1), 1500));
            $product->setCurrentCondition('défauts mineurs non-visibles');
            $product->setAge($this->age[rand(0, 2)]);
            $product->setDescription('Vide-appartement témoin : rien n\'est à vendre !');
            $product->setPicture('\build\images\type-' . $index . '.jpeg');
            $product->setIsSold(false);

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
