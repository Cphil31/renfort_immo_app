<?php

namespace App\Form;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ListContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contact', EntityType::class, [ 
                'class' => Contact::class,
                'choice_label' => fn(Contact $contact) => $contact->getNom()." ".$contact->getPrenom(),
                'multiple' => false,
                'query_builder' => fn (ContactRepository $contactRepo) => $contactRepo->createQueryBuilder('c')->orderby('c.nom','ASC'),
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
