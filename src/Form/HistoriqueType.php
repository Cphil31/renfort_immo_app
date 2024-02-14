<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Historique;
use App\Repository\ContactRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoriqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('historique')
            ->add('title')
            ->add('contact' , EntityType::class, [
                'class' => Contact::class,
                'choice_label' => fn(Contact $contact) => $contact->getNom()." ".$contact->getPrenom(),
                'multiple' => false,
                'query_builder' => fn (ContactRepository $contactRepo) => $contactRepo->createQueryBuilder('c')->orderby('c.nom','ASC'),
                
                ] )
            ->add('entreprise')
            ->add('produit')
            ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Historique::class,
        ]);
    }
}
