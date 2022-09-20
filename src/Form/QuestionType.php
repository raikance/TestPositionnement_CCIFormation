<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', TextType::class,[
                'label' => 'Intitulé de la question'])
            ->add('answer1', TextType::class,[
                'label' => 'Réponse 1'])
            ->add('answer2', TextType::class,[
                'label' => 'Réponse 2'])
            ->add('answer3', TextType::class,[
                'label' => 'Réponse 3'])
            ->add('answer4', TextType::class,[
                'label' => 'Réponse 4'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
