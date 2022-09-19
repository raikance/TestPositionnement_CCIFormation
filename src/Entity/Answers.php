<?php

namespace App\Entity;

use App\Repository\AnswersRepository;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: AnswersRepository::class)]
class Answers extends \App\Entity\Qcm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $answer1 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $answer2 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $answer3 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $answer4 = null;

    #[ORM\ManyToOne(inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: true)]
    private ?question $id_question = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAnswer1(): ?bool
    {
        return $this->answer1;
    }

    public function setAnswer1(bool $answer1): self
    {
        $this->answer1 = $answer1;

        return $this;
    }

    public function isAnswer2(): ?bool
    {
        return $this->answer2;
    }

    public function setAnswer2(bool $answer2): self
    {
        $this->answer2 = $answer2;

        return $this;
    }

    public function isAnswer3(): ?bool
    {
        return $this->answer3;
    }

    public function setAnswer3(?bool $answer3): self
    {
        $this->answer3 = $answer3;

        return $this;
    }

    public function isAnswer4(): ?bool
    {
        return $this->answer4;
    }

    public function setAnswer4(?bool $answer4): self
    {
        $this->answer4 = $answer4;

        return $this;
    }

    public function getIdQuestion(): ?question
    {
        return $this->id_question;
    }

    public function setIdQuestion(?question $id_question): self
    {
        $this->id_question = $id_question;

        return $this;
    }

}
