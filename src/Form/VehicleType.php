<?php

namespace App\Form;

use App\Entity\Vehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $required = $options['required'];
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'In stock' => 'In stock',
                    'In arrival' => 'In arrival',
                    'Reserved' => 'Reserved'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Personal vehicle' => 'Personal vehicle',
                    'Commercial vehicle' => 'Commercial vehicle',
                    'Work machine' => 'Work machine'
                ]
            ])
            ->add('mark')
            ->add('model')
            ->add('manufactureYear', IntegerType::class, [
                'attr' => [
                    'min'=> 1950,
                    'max' => 2021
                ]
            ])
            ->add('modelYear', IntegerType::class, [
                'attr' => [
                    'min'=> 1950,
                    'max' => 2021
                ]
            ])
            ->add('kilometers', IntegerType::class)
            ->add('power', IntegerType::class, [
                'label' => "Power [kW]"
            ])
            ->add('gearbox', ChoiceType::class, [
                'choices' => [
                    'Manual' => 'Manual',
                    'Semi-automatic' => 'Semi-automatic',
                    'Automatic' => 'Automatic'
                ]
            ])
            ->add('gears', IntegerType::class, [
                'attr' => [
                    'min' => 4,
                    'max' => 9
                ]
            ])
            ->add('consumption')
            ->add('price');

        if($required)
        {
            $builder ->add('imageFile', FileType::class, [
                'mapped' => false,
                'multiple' => true
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
            'required' => true,
        ]);
    }
}
