<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\AppelsRecus;
use App\Repository\ContactRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AppelsRecusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date', DateTimeType::class , [ 
            'label' => 'Date',
            'widget' => 'single_text',
             // prevents rendering it as type="date", to avoid HTML5 date pickers
            'html5' => true,
            'input'  => 'datetime',
            'attr' => ['class' => 'form-control'],

            // adds a class that can be selected in JavaScript
            'attr' => ['class' => 'js-datepicker form-control'],
            'placeholder' => 'Date',

        ])
            ->add('contact' , EntityType::class, [
                'class' => Contact::class,
                'attr' => ['class' => 'form-select'],
                'choice_label' => fn(Contact $contact) => $contact->getNom()." ".$contact->getPrenom(),
                'multiple' => false,
                'query_builder' => fn (ContactRepository $contactRepo) => $contactRepo->createQueryBuilder('c')->orderby('c.nom','ASC'),
                
                ] )
                ->add('mission', EntityType::class, [
                    'class' => Mission::class,
                    'attr' => ['class' => 'form-select'],

                ])
                ->add('objet',TextareaType::class,[
                    'label' => 'Objet',
                    'attr' => ['class' => 'form-control'],
                ])
                ->add('appeller')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AppelsRecus::class,
        ]);
    }
}
