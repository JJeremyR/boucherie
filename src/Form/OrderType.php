<?php

namespace App\Form;

use App\Entity\Adress;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
            ->add('adresses', EntityType::class, [
                'label'=>'Adresse De Livraison', 
                'required'=>true,
                'class'=>Adress::class,
                'choices'=>$user->getAdresses(),
                'multiple'=>false,
                'expanded'=>true,
                ])
            ->add('carriers', EntityType::class, [
                'label'=>'Type De Livraison', 
                'required'=>true,
                'class'=>Carrier::class,
                'multiple'=>false,
                'expanded'=>true,
                ]) 
            ->add('submit', SubmitType::class, [
                'label'=>'Payer',
                'attr' =>[
                    'class'=>'btn btn-block btn-lg btn-warning mt-3',
                ]
            ])   
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user'=>array()
        ]);
    }
}
