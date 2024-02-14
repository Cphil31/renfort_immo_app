<?php

namespace App\Form;

use App\Entity\Intervenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IntervenantProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('observation')
            ->add('cout')
            ->add('date')
            ->add('realisations')
            ->add('duree')
            ->add('payer')
            ->add('tache')
            ->add('statut')
            ->add('entreprise')
            ->add('contact')
            ->add('produit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervenant::class,
        ]);
    }
}
