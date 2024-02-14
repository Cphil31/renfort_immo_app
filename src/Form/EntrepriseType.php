<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Entreprise;
use App\Entity\StatutEntreprise;
use App\Repository\ContactRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('statut', EntityType::class, [
                'class' => StatutEntreprise::class,
                'label' => 'Statut',
                'attr' => ['class' => "form-select"]
               ])
            ->add('raison_sociale', TextType::class, [
             'label' => 'raison_sociale',
             'attr' => ['class' => "form-control"]
            ])
            ->add('siret', TextType::class, [
                'label' => 'siret',
                'required'   => false,
                'attr' => ['class' => "form-control"]
               ])
            ->add('naf', TextType::class, [
                'label' => 'naf',
                'required'   => false,
                'attr' => ['class' => "form-control"]
               ])/*
            ->add('contacts', EntityType::class, [
                'class' => Contact::class,
                'choice_label' => fn(Contact $contact) => $contact->getNom()." ".$contact->getPrenom(),
                'required'   => false,
                'multiple' => true,
                'query_builder' => fn (ContactRepository $contactRepo) => $contactRepo->createQueryBuilder('c')->orderby('c.nom','ASC'),

            ])
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}