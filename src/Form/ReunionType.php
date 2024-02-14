<?php

namespace App\Form;

use App\Entity\Reunion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReunionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet')
            ->add('date')
            ->add('content')
            ->add('coutLocationSalle')
            ->add('CoutLocationMateriel')
            ->add('CoutRestauration')
            ->add('coutCollation')
            ->add('duree')
            ->add('forfaitHoraire')
            ->add('tache')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reunion::class,
        ]);
    }
}
