<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rue')
            ->add('code_postal')
            ->add('ville')
            ->add('departement')
            ->add('region')
            ->add('pays')
            ->add('statut')
            ->add('facturation',CheckboxType::class,[
                'data' => false,
            ])
            /*
            ->add('contact' , EntityType::class, [
                'class' => Contact::class,
                'choice_label' => fn(Contact $contact) => $contact->getNom()." ".$contact->getPrenom(),
                'multiple' => false,
                'query_builder' => fn (ContactRepository $contactRepo) => $contactRepo->createQueryBuilder('c')->orderby('c.nom','ASC'),

            ] )
            ->add('produit')
            ->add('entreprise')
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
