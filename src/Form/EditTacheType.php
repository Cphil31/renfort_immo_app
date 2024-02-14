<?php

namespace App\Form;

use App\Entity\Tache;
use App\Entity\StatutTache;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EditTacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('statut',EntityType::class,[
                'class'=>StatutTache::class,
            ])
            ->add('date', DateTimeType::class , [ 
                'widget' => 'single_text',
                 // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                'input'  => 'datetime',
    
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker form-control'],
                'placeholder' => 'Date',
    
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}
