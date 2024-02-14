<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Intervenant;
use App\Repository\ContactRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class NewIntervenantProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('statut')
        ->add('contact' , EntityType::class, [
            'class' => Contact::class,
            'choice_label' => fn(Contact $contact) => $contact->getNom()." ".$contact->getPrenom(),
            'multiple' => false,
            'query_builder' => fn (ContactRepository $contactRepo) => $contactRepo->createQueryBuilder('c')->orderby('c.nom','ASC'),

        ] )
        ->add('date', DateTimeType::class , [ 
            'widget' => 'single_text',
             // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => true,
            'input'  => 'datetime',

            // adds a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker'],
            'placeholder' => 'Date',

        ])
        ->add('duree',TimeType::class,[
            'widget' => 'single_text',
                 // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                'input'  => 'datetime_immutable',
    
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker form-control'],
                'placeholder' => 'Durée',
        ])
        ->add('realisations',TextareaType::class)
        ->add('observation', TextareaType::class)
        ->add('payer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervenant::class,
        ]);
    }
}
