<?php

namespace App\Form;

use App\Entity\Colis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType ;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationColisType extends AbstractType
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
        ->add('Heure_D_Arriver', TimeType::class, [
            'input'  => 'string',
            'widget' => 'choice',
        ])
           
        
        ->add('Size', ChoiceType::class, [
            'choices' => [
                '[1kg-5kg]' => 'small ' ,
                '[5kg-10kg]' => 'Medium',
                '[10kg-15kg]' => 'large',
            ],])
        ->add('Categorie', ChoiceType::class, [
            'choices' => [
                'Electroniques' => 'Electroniques' ,
                'Vetements' => 'Vetements',
                'Nourritures' => 'Nourritures',
                'Medicaments' => 'Medicaments',
                'Papiers' => 'Papiers',
              
    
            ],])
        ->add('Type')
        ->add('Prix')
        ->add('image',FileType::class, array('required' => false)
            )
       
        
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
            'data_class' => Colis::class,
        ]);
    }
}
