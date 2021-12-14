<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Editeur;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'Titre :' ])
            ->add('nbPages',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'nombre page : '])
            ->add('dateEdition',DateType::class  ,['attr'=>['class'=>'form-control'],'label'=>'date daddition : ','widget'=>'single_text'])
            ->add('nbExemplaires',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'nombre exemplaire : '])
            ->add('prix',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'prix : '])
            ->add('isbn',TextType::class,['attr'=>['class'=>'form-control'],'label'=>'ISBN : '])
            ->add('editeur',EntityType::class,
                ['attr'=>['class'=>'form-control'],
                    'label'=>"Editeur : ",
                    'class'=>Editeur::class,
                    'multiple'=>false,
                    'expanded'=>false,
                    'choice_label'=>'nomEditeur'])
            ->add('categorie',EntityType::class,
                ['attr'=>['class'=>'form-control'],
                    'label'=>'categories : ',
                    'class'=>Categorie::class,
                    'multiple'=>false,
                    'expanded'=>false,
                    'choice_label'=>'designation'])
            ->add('auteurs',EntityType::class,
            ['attr'=>['class'=>'form-control'],
                'label'=>'Auteurs : ',
                'class'=>Auteur::class,
                'multiple'=>true,
                'expanded'=>false,
                'choice_label'=>function($Auteur){
                return $Auteur->getPrenom()." ".$Auteur->getNom();
                }])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
