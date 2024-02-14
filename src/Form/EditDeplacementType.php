<?php

namespace App\Form;

use DateTimeImmutable;
use App\Entity\Deplacement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EditDeplacementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateTimeType::class , [ 
                'widget' => 'single_text',
                 // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                'input'  => 'datetime_immutable',
                'required'=> false,
    
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'placeholder' => 'Date',
    
            ])
            ->add('lieu')
            ->add('cout')
            ->add('observation')
            ->add('coutPeage')
            ->add('coutCarburant')
            ->add('duree')
            ->add('statut')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deplacement::class,
        ]);
    }
}
