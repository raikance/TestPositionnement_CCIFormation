<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Question;
Use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies() {
        return array(
            QcmFixtures::class,
        );
    }

    public function load(ObjectManager $manager): void
    {
        $question = new Question();
        $question->setQuestion("Quelle est la couleur du cheval blanc d'Henri IV");
        $question->setAnswer1("Blue");
        $question->setAnswer2("White");
        $question->setAnswer3("Black");
        $question->setAnswer4("Brown");
        $question->setIdQcm($this->getReference("QCM1"));
        $manager->persist($question);

        $manager->flush();
    }
}
