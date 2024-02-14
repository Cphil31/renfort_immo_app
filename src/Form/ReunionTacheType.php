<?php

namespace App\Form;

use App\Entity\Reunion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReunionTacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet')
            ->add('date',DateType::class,[
                'widget' => 'single_text',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
               'html5' => true,
               'input'  => 'datetime',
   
               // adds a class that can be selected in JavaScript
               'attr' => ['class' => 'js-datepicker'],
               'placeholder' => 'Date', 
            ])
            ->add('content')
            ->add('coutLocationSalle')
            ->add('CoutLocationMateriel')
            ->add('CoutRestauration')
            ->add('coutCollation')
            ->add('duree',TimeType::class,[
                'widget' => 'single_text',
                 // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                'input'  => 'datetime',
    
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker'],
                'placeholder' => 'Time',
            ])
            ->add('forfaitHoraire')
            ->add('payer',CheckboxType::class,[
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reunion::class,
        ]);
    }
}
