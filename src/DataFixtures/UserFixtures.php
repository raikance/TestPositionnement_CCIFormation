<?php

namespace App\DataFixtures;

use App\Entity\Interfaces\IRoles;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements IRoles
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this -> userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("admin@admin.fr");
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            "raikette"
            )
        );
        $user->setNom("NomFam");
        $user->setPrenom("Jean");
        $user->addRoles(self::ROLE_ADMIN);
        $manager->persist($user);
        $this->addReference("ADMIN", $user);

        $user = new User();
        $user->setEmail("user@cciformation.fr");
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            "raiketteUser"
            )
        );
        $user->setNom("Pralus");
        $user->setPrenom("François");
        $user->addRoles(self::ROLE_USER);

        $manager->persist($user);
        $manager->flush();
    }
}
