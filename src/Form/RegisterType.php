<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'=>'Prénom',
                'required'=>true, 
                'constraints'=>new Length(['min'=>2, 'max'=>30]),
                'attr'=>['placeholder'=>'Fabien']
            ])
            ->add('lastname', TextType::class, [
                'label'=>'Nom de Famille',
                'required'=>true, 
                'constraints'=>new Length(['min'=>2, 'max'=>30]),
                'attr'=>['placeholder'=>'Potencier']
            ])
            ->add('phone', TelType::class, [
                'label'=>'Numéro De Téléphone',
                'required'=>true,
                'constraints'=>new Length(['min'=>10, 'max'=>14]),
                'attr'=>['placeholder'=>'03.21.45.67.89']
            ])

            ->add('email', EmailType::class, [
                'label'=>'Adresse Email', 
                'required'=>true,
                'constraints'=>new Length(['min'=>2, 'max'=>60]),
                'attr'=>['placeholder'=>'fabienpotencier@symfony.com']
            ])
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class, 
                'invalid_message'=>'Difference entre les 2 Mots De Passes',
                'label'=>'Mot De Passe', 
                'required'=>true,
                'first_options'=>['label'=>'Mot De Passe', 'attr'=>['placeholder'=>'*********']],
                'second_options'=>['label'=>'Confirmation Mot De Passe', 'attr'=>['placeholder'=>'*********']],
            ])
            ->add('submit', SubmitType::class, ['label'=>'S\'inscrire', 'attr'=>['class'=>'btn btn-block btn-lg btn-warning mt-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
