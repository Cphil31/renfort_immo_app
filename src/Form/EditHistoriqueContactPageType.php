<?php

namespace App\Form;

use App\Entity\Historique;
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EditHistoriqueContactPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('created_At',  DateTimeType::class , [ 
            'widget' => 'single_text',
             // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => true,
            'input'  => 'datetime_immutable',

            // adds a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker form-control'],
            'placeholder' => 'Date',

        ])
         ->add('title')
         ->add('historique')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Historique::class,
        ]);
    }
}
