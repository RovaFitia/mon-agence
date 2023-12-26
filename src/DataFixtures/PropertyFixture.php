<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR') ;

        for($i = 0 ; $i < 100 ; $i++) {
            $property = new Property() ;
            $property
                ->setTitle($faker->words(5,true))
                ->setDescription($faker->sentences(5, true))
                ->setSurface($faker->numberBetween(20,350))
                ->setRooms($faker->numberBetween(2,10))
                ->setBedrooms($faker->numberBetween(1,9))
                ->setFloor($faker->numberBetween(0,15))
                ->setPrice($faker->numberBetween(100000,1000000))
                ->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1) )
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setPostalCode($faker->postcode)
                ->setSold(false);
            $manager->persist($property);
        }
    //YmHT4LAM8H7
        $manager->flush();
    }
}
