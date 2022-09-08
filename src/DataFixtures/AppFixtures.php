<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <= 10; $i++) {
            $user = new User();
            $user->setName($faker->name());
            $user->setPseudo($faker->word());
            $user->setEmail($faker->email());
            $user->setBiography($faker->text());
            $user->setBirthdate($faker->dateTime());
            $manager->persist($user);
        }


        $manager->persist($user);

        $manager->flush();
    }
}
