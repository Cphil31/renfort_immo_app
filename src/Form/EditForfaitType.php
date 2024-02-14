<?php

namespace App\Form;

use App\Entity\Forfait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EditForfaitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('prix')
            ->add('date', DateTimeType::class , [ 
                'widget' => 'single_text',
                 // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                'input'  => 'datetime',
    
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'placeholder' => 'Date',
    
            ])
            ->add('date_reglement', DateType::class , [ 
                'widget' => 'single_text',
                 // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                'input'  => 'datetime',
    
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'placeholder' => 'Date de reglement',
                'required' => false ,
    
            ])
            
            ->add('payer',CheckboxType::class,[
                'required' => false,
            ] )

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Forfait::class,
        ]);
    }
}
