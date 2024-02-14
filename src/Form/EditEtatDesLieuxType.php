<?php

namespace App\Form;

use App\Entity\EtatDesLieux;
use App\Entity\StatutEtatDesLieux;
use Symfony\Component\Form\AbstractType;
use App\Repository\StatutEtatDesLieuxRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditEtatDesLieuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createdAt')
            ->add('observation')
            ->add('statut',EntityType::class,[
                'class' => StatutEtatDesLieux::class,
                'choice_label' => fn(StatutEtatDesLieux $statutEtatDesLieux ) => $statutEtatDesLieux->getStatut(),
                'query_builder' => fn (StatutEtatDesLieuxRepository $statutEtatDesLieuxRepository) => $statutEtatDesLieuxRepository->createQueryBuilder('c')->orderby('c.statut','ASC'),
    
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EtatDesLieux::class,
        ]);
    }
}
