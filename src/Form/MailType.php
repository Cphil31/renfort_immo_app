<?php

namespace App\Form;

use App\Entity\Mail;
use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Repository\ContactRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',null,[
                'attr' => ['class' => 'form-control'],
            ])
            ->add('objet',null,[
                'attr' => ['class' => 'form-control'],
            ])
            ->add('mission',null,[
                'attr' => ['class' => 'form-select'],
            ])
            ->add('created_at',DateTimeType::class,[ 
                'widget' => 'single_text',
                 // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                'input'  => 'datetime_immutable',
                'label' => 'Date',
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'js-datepicker form-control'],
                'placeholder' => 'Date',
    
            ])
            ->add('statut',null,[
                'attr' => ['class' => 'form-select'],
            ])
            ->add('contact' , EntityType::class, [
                'class' => Contact::class,
                'choice_label' => fn(Contact $contact) => $contact->getNom()." ".$contact->getPrenom(),
                'multiple' => false,
                'attr' => ['class' => 'form-select'],
                'query_builder' => fn (ContactRepository $contactRepo) => $contactRepo->createQueryBuilder('c')->orderby('c.nom','ASC'),

            ] )
            ->add('entreprise',null,[
                'attr' => ['class' => 'form-select'],
            ])
            ->add('content',null,[
                'attr' => ['class' => 'form-control'],
            ])
            ->add('mission',null,[
                'attr' => ['class' => 'form-select'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mail::class,
        ]);
    }
}
