<?php

namespace App\Form;

use App\Entity\Trajet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType ;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationTrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Point_De_Depart',CountryType::class, [
    
            'error_mapping' => [
                'matchingCityAndZipCode' => 'city',
            ],
        ])
        ->add('Point_D_Arriver',CountryType::class, [
        
            'error_mapping' => [
                'matchingCityAndZipCode' => 'city',
            ],
        ])
        ->add('Date_De_Depart',DateType::class,[
            'placeholder' => [
                'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
            ]
        ])
        ->add('Date_D_Arriver',DateType::class,[
            'placeholder' => [
                'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
            ]
        ])
        ->add('Heure_De_Depart', TimeType::class, [
            'input'  => 'string',
            'widget' => 'choice',
        ])
        ->add('Heure_D_Arriver', TimeType::class, [
            'input'  => 'string',
            'widget' => 'choice',
        ])
        ->add('save', SubmitType::class , [
            'attr' => [
                'class'=> 'boxed-btn2'
            ]
        ])
    
            
        -> getForm();
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trajet::class,
        ]);
    }
}
