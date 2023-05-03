<?php

namespace App\Form;

use App\Entity\Material;
use App\Entity\Ergonomics;
use App\Entity\Software;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
        // Ajout d'un champ "capacity" au formulaire
            ->add('capacity')

            // Ajout d'un champ "material" au formulaire avec un EntityType qui référence l'entité Material
            ->add('material', EntityType::class, [
                'class' => Material::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            // Ajout d'un champ "ergonomics" au formulaire avec un EntityType qui référence l'entité Ergonomics
            ->add('ergonomics', EntityType::class, [
                'class' => Ergonomics::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            // Ajout d'un champ "software" au formulaire avec un EntityType qui référence l'entité Software
            ->add('software', EntityType::class, [
                'class' => Software::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // Configuration des options du formulaire
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
