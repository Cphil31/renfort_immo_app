<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Intervenant;
use App\Repository\ContactRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IntervenantEditProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('statut',TypeTextType::class,[
            'attr'=>[
                'class'=>'form-control',
            ]
        ])
        ->add('contact' , EntityType::class, [
            'attr'=>[
                'class'=>'form-control',
            ],
            'class' => Contact::class,
            'choice_label' => fn(Contact $contact) => $contact->getNom()." ".$contact->getPrenom(),
            'multiple' => false,
            'query_builder' => fn (ContactRepository $contactRepo) => $contactRepo->createQueryBuilder('c')->orderby('c.nom','ASC'),

        ] )
        ->add('payer',CheckboxType::class,[
            'attr'=>[
                'class'=>'form-control',
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervenant::class,
        ]);
    }
}
