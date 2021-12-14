<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Prenom : '])
            ->add('nom',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Nom : '])
            ->add('biographie', TextareaType::class,['attr'=>['class'=>'form-control'],'label'=>'bibiographe : '])
            ->add('livres',EntityType::class,
                ['attr'=>['class'=>'form-control'],
                    'label'=>'Livers : ',
                    'class'=>Livre::class,
                    'multiple'=>true,
                    'expanded'=>false,
                    'choice_label'=>'titre'

                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
