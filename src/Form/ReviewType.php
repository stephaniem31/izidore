<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Votre nom'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Commentaire',
                'attr' => [
                    'placeholder' => 'Racontez-nous comment s\'est passée votre expérience d\'achat sur Izidore...',
                ],
            ])
            ->add('rate', ChoiceType::class, [
                'choices' => [
                    '1 ⭐' => 1,
                    '2 ⭐' => 2,
                    '3 ⭐' => 3,
                    '4 ⭐' => 4,
                    '5 ⭐' => 5,
                ],
                'multiple' => false,
                'expanded' => true,
                'label_attr' => [
                    'class' => 'radio-inline'
                ],
                'label' => 'Votre note'

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
