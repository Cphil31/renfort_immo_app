<?php

namespace App\Form;

use App\Entity\EtatDesLieux;
use App\Entity\StatutEtatDesLieux;
use Symfony\Component\Form\AbstractType;
use App\Repository\StatutEtatDesLieuxRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class NewEtatDesLieuxTypesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('createdAt' , DateType::class , [ 
            'widget' => 'choice',
            'input'  => 'datetime_immutable',
            'widget' => 'single_text',
             // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => true,

            // adds a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker'],
            'placeholder' => 'Date',

        ])
        ->add('statut',EntityType::class,[
            'class' => StatutEtatDesLieux::class,
            'choice_label' => fn(StatutEtatDesLieux $statutEtatDesLieux ) => $statutEtatDesLieux->getStatut(),
            'query_builder' => fn (StatutEtatDesLieuxRepository $statutEtatDesLieuxRepository) => $statutEtatDesLieuxRepository->createQueryBuilder('c')->orderby('c.statut','ASC'),

        ])
        ->add('observation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EtatDesLieux::class,
        ]);
    }
}