<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $answer1 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $answer2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answer3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answer4 = null;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: true)]
    private ?qcm $id_qcm = null;

    #[ORM\OneToMany(mappedBy: 'id_question', targetEntity: Answers::class, orphanRemoval: true)]
    private Collection $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer1(): ?string
    {
        return $this->answer1;
    }

    public function setAnswer1(string $answer1): self
    {
        $this->answer1 = $answer1;

        return $this;
    }

    public function getAnswer2(): ?string
    {
        return $this->answer2;
    }

    public function setAnswer2(string $answer2): self
    {
        $this->answer2 = $answer2;

        return $this;
    }

    public function getAnswer3(): ?string
    {
        return $this->answer3;
    }

    public function setAnswer3(?string $answer3): self
    {
        $this->answer3 = $answer3;

        return $this;
    }

    public function getAnswer4(): ?string
    {
        return $this->answer4;
    }

    public function setAnswer4(?string $answer4): self
    {
        $this->answer4 = $answer4;

        return $this;
    }

    public function getIdQcm(): ?qcm
    {
        return $this->id_qcm;
    }

    public function setIdQcm(?qcm $id_qcm): self
    {
        $this->id_qcm = $id_qcm;

        return $this;
    }

    /**
     * @return Collection<int, Answers>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answers $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setIdQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answers $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getIdQuestion() === $this) {
                $answer->setIdQuestion(null);
            }
        }

        return $this;
    }
}
