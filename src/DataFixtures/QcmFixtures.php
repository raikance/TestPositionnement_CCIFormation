<?php

namespace App\DataFixtures;

use App\Entity\Qcm;
use App\Entity\User;
use App\DataFixtures\UserFixtures;
use App\Entity\Interfaces\IRoles;
use Doctrine\Bundle\FixturesBundle\Fixture;
Use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class QcmFixtures extends Fixture implements DependentFixtureInterface, IRoles
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    public function getDependencies() {
        return array(
            UserFixtures::class,
        );
    }

    public function load(ObjectManager $manager): void
    {
        //$nowdate = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $faker = Factory::create('fr_FR');

        $qcm = new Qcm();
        $qcm->setTitle("Mon premier QCM");
        $qcm->setDescription("Du blabla");
        $qcm->setcreatedAt($faker->dateTimeBetween('-6 month', 'now'));
        $qcm->setIdUser($this->getReference("ADMIN"));
        //$qcm->setIdUser($this->getReference(UserFixtures::ROLE_ADMIN)->getIdUser());
        $manager->persist($qcm);
        $this->addReference("qcm", $qcm);

        $manager->flush();
    }
}
