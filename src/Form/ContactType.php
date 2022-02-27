<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('field_name')
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
            ->add('email', EmailType::class, [
                'label'=>'Adresse Email', 
                'required'=>true,
                'constraints'=>new Length(['min'=>2, 'max'=>60]),
                'attr'=>['placeholder'=>'fabienpotencier@symfony.com']
            ])
            ->add('subject', ChoiceType::class, [
                'required' => true,
                'label' => 'Sujet :',
                'attr' => [
                    'class'=> 'form-control',
                ],
                'choices' => [
                    'Choisir Un Sujet' => 'null',
                    'Service Client' => 'Client',
                    'WebMaster' => 'Admin',
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message :',
                'attr' => [
                    'rows'=> 13,
                ],

            ])

            ->add('submit', SubmitType::class, ['label'=>'Envoyer', 'attr'=>['class'=>'btn btn-block btn-lg btn-warning mt-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
