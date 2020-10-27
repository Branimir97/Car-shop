<?php


namespace App\Form;


use App\Entity\AdditionalEquipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdditionalEquipmentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("ABS", CheckboxType::class, [
                'label' => 'ABS',
                'required' => false
            ])
            ->add("ESP", CheckboxType::class, [
                'label' => 'ESP',
                'required' => false
            ])
            ->add("remoteLocking", CheckboxType::class, [
                'label' => 'Remote lock',
                'required' => false
            ])
            ->add("isofix", CheckboxType::class, [
                'label' => 'Isofix',
                'required' => false
            ])
            ->add("engineImmobilizer", CheckboxType::class, [
                'label' => 'Engine Immobilizer',
                'required' => false
            ])
            ->add("startStop", CheckboxType::class, [
                'label' => 'Start/Stop',
                'required' => false
            ])
            ->add("hac", CheckboxType::class, [
                'label' => 'HAC',
                'required' => false
            ])
            ->add("rainSensors", CheckboxType::class, [
                'label' => 'Rain sensors',
                'required' => false
            ])
            ->add("lightSensors", CheckboxType::class, [
                'label' => 'Light sensors',
                'required' => false
            ])
            ->add("alarm", CheckboxType::class, [
                'label' => 'Alarm',
                'required' => false
            ])
            ->add("multifunctionalSteeringWheel", CheckboxType::class, [
                'label' => 'Multifunctional steering wheel',
                'required' => false
            ])
            ->add("parkSensors", CheckboxType::class, [
                'label' => 'Park sensors',
                'required' => false
            ])
            ->add("alloyWheels", CheckboxType::class, [
                'label' => 'Alloy wheels',
                'required' => false
            ])
            ->add("clima", CheckboxType::class, [
                'label' => 'Clima',
                'required' => false
            ])
            ->add("thirdStopLight", CheckboxType::class, [
                'label' => 'Third stop light',
                'required' => false
            ])
            ->add("cruiseControl", CheckboxType::class, [
                'label' => 'Cruise control',
                'required' => false
            ])
            ->add("electricWindowLiftersFront", CheckboxType::class, [
                'label' => 'Front electric window lifters',
                'required' => false
            ])
            ->add("electricWindowLiftersRear", CheckboxType::class, [
                'label' => 'Rear electric window lifters',
                'required' => false
            ])
            ->add("electricFoldingMirrors", CheckboxType::class, [
                'label' => 'Electric folding mirrors',
                'required' => false
            ])
            ->add("tintedGlass", CheckboxType::class, [
                'label' => 'Tinted glass',
                'required' => false
            ])
            ->add("fogLights", CheckboxType::class, [
                'label' => 'Fog lights',
                'required' => false
            ])
            ->add("roofWindow", CheckboxType::class, [
                'label' => 'Roof window',
                'required' => false
            ])
            ->add("touchRadio", CheckboxType::class, [
                'label' => 'Touch radio',
                'required' => false
            ])
            ->add("metallicColor", CheckboxType::class, [
                'label' => 'Metallic color',
                'required' => false
            ])
            ->add("childLock", CheckboxType::class, [
                'label' => 'Child lock',
                'required' => false
            ])
            ->add("LEDLightsFront", CheckboxType::class, [
                'label' => 'Front LED lights',
                'required' => false
            ])
            ->add("LEDLightsRear", CheckboxType::class, [
                'label' => 'Rear LED lights',
                'required' => false
            ])
            ->add("LedInterrior", CheckboxType::class, [
                'label' => 'LED interior',
                'required' => false
            ])
            ->add("leatherSeats", CheckboxType::class, [
                'label' => 'Leather seats',
                'required' => false
            ])
            ->add("sportSeats", CheckboxType::class, [
                'label' => 'Sport seats',
                'required' => false
            ])
            ->add("rearParkingCamera", CheckboxType::class, [
                'label' => 'Rear parking camera',
                'required' => false
            ])
            ->add("seatHeating", CheckboxType::class, [
                'label' => 'Seat heating',
                'required' => false
            ])
            ->add("handsfree", CheckboxType::class, [
                'label' => 'Handsfree',
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Save'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdditionalEquipment::class
        ]);
    }
}