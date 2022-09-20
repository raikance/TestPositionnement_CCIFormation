<?php

namespace App\Form;

use App\Entity\Answers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnswersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('answer1', CheckboxType::class,[
                'label' => 'réponse 1'])
            ->add('answer2', CheckboxType::class,[
                'label' => 'réponse 2'
            ])
            ->add('answer3', CheckboxType::class,[
                'label' => 'réponse 3'
            ])
            ->add('answer4', CheckboxType::class,[
                'label' => 'réponse 4'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Answers::class,
        ]);
    }
}
