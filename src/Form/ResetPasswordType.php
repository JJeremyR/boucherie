<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('new_password', RepeatedType::class, [
                'type'=>PasswordType::class, 
                'invalid_message'=>'Difference entre les 2 Mots De Passes',
                'label'=>'Réinitialisation Du Mot De Passe',
                'mapped'=>true, 
                'required'=>true,
                'first_options'=>['label'=>'Nouveau Mot De Passe', 'attr'=>['placeholder'=>'*********']],
                'second_options'=>['label'=>'Confirmation Nouveau Mot De Passe', 'attr'=>['placeholder'=>'*********']],
            ])
            ->add('submit', SubmitType::class, ['label'=>'Modifier', 'attr'=>['class'=>'btn btn-block btn-lg btn-warning mt-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
