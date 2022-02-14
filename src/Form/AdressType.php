<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Definir un Nom a L\'adresse', 'attr'=>['placeholder'=>'Domicile Principal']])
            ->add('firstname', TextType::class, ['label'=>'Prénom', 'attr'=>['placeholder'=>'Benoit']])
            ->add('lastname', TextType::class, ['label'=>'Nom', 'attr'=>['placeholder'=>'Paux']])
            ->add('company', TextType::class, ['label'=>'Nom de la société','required'=>false, 'attr'=>['placeholder'=>'Boucherie Benoit Paux - (Facultatif)']])
            ->add('adress', TextType::class, ['label'=>'Adresse', 'attr'=>['placeholder'=>'4 Place de L\'eglise']])
            ->add('postal', TextType::class, ['label'=>'Code Postal', 'attr'=>['placeholder'=>'62910']])
            ->add('city', TextType::class, ['label'=>'Ville', 'attr'=>['placeholder'=>'Eperlecques']])
            /*->add('country', CountryType::class, ['label'=>'Pays', 'attr'=>['placeholder'=>'France']])*/
            ->add('phone', TelType::class, ['label'=>'Numéro de téléphone fixe', 'attr'=>['placeholder'=>'03.21.88.13.26']])
            ->add('cell', TelType::class, ['label'=>'Numéro de téléphone portable','required'=>false, 'attr'=>['placeholder'=>'07.85.82.62.08 - (Facultatif)']])
            ->add('submit', SubmitType::class, ['label'=>'Enregistrer', 'attr'=>['class'=>'btn btn-block btn-lg btn-warning mt-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
