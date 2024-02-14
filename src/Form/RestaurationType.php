<?php

namespace App\Form;

use App\Entity\Restauration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RestaurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etablissement')
            ->add('coutRepasPersonnel')
            ->add('coutRepasClients')
            ->add('duree',TimeType::class,[
                'widget' => 'single_text',
                 // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                'input'  => 'datetime_immutable',
    
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'placeholder' => 'Date',
            ])
            ->add('forfait')
            ->add('date',DateTimeType::class, [
                'widget' => 'single_text',
                 // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                'input'  => 'datetime_immutable',
    
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'placeholder' => 'Date',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restauration::class,
        ]);
    }
}
