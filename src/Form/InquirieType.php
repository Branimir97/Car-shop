<?php

namespace App\Form;

use App\Entity\Inquirie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InquirieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vehicle', TextType::class, [
                'attr' => [
                    'readonly'=>true
                ],
                'mapped'=>false
            ])
            ->add('content', TextareaType::class)
            ->add('submit', SubmitType::class, [
                'label' => 'Send contact form'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inquirie::class,
        ]);
    }
}
