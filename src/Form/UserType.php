<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom',TextType::class,[
                'label' => 'Nom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('prenom',TextType::class,[
                'label' => 'Prenom',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email',EmailType::class,[
                'attr' => ['class' => 'form-control'],
            ])
            
            ->add('password',HiddenType::class,[

                'attr' => ['class' => 'form-control'],
                'required'   => false,
            ])
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
