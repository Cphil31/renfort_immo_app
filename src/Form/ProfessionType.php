<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Entreprise;
use App\Entity\Profession;
use App\Repository\ContactRepository;
use App\Repository\EntrepriseRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('profession')
            ->add('poste')
            ->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'multiple' => false,
                'choice_label' => fn(Entreprise $entreprise) => $entreprise->getRaisonSociale(),
                'query_builder' => fn (EntrepriseRepository $entrepriseRepository) => $entrepriseRepository->createQueryBuilder('e')->orderby('e.raison_sociale','ASC'),
             ] )
            ->add('contact' , EntityType::class, [
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
            'data_class' => Profession::class,
        ]);
    }
}
