<?php

namespace App\DataFixtures;

use App\Entity\Publication;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setName($faker->name());
            $user->setPseudo(ucfirst($faker->userName()));
            $user->setEmail($faker->email());
            $user->setBiography($faker->text());
            $user->setBirthdate($faker->dateTimeBetween('-1 weeks', '-1 days'));
            $user->setPassword($this->hasher->hashPassword($user, 'password'));
            $manager->persist($user);
            $this->addReference('user-'.$i, $user);
        }

        for ($i = 0; $i <= 40; $i++) {
            $publication = new Publication();
            $publication->setContent($faker->text());
            $publication->setCreatedAt($faker->dateTimeBetween('-1 days', '-1hours'));
            $publication->setUser($this->getReference('user-'.rand(1, 10)));
            $manager->persist($publication);
        }

        $manager->flush();
    }
}
