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

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,['disabled'=>true,'label'=>'Prénom'])
            ->add('lastname', TextType::class,['disabled'=>true,'label'=>'Nom'])
            ->add('phone', TelType::class,['disabled'=>true,'label'=>'Numéro de Téléphone'])
            ->add('email', EmailType::class,['disabled'=>true,'label'=>'Adresse Email'])
            ->add('old_password', PasswordType::class,['label'=>'Mot De Passe Actuel','mapped'=>false,'attr'=>['placeholder'=>'*********']])
            ->add('new_password', RepeatedType::class, [
                'type'=>PasswordType::class, 
                'invalid_message'=>'Difference entre les 2 Mots De Passes',
                'label'=>'Nouveau Mot De Passe',
                'mapped'=>false, 
                'required'=>true,
                'first_options'=>['label'=>'Nouveau Mot De Passe', 'attr'=>['placeholder'=>'*********']],
                'second_options'=>['label'=>'Confirmation Nouveau Mot De Passe', 'attr'=>['placeholder'=>'*********']],
            ])
            ->add('submit', SubmitType::class, ['label'=>'Modifier'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
