<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Film;
use App\Entity\Horaire;
use App\Entity\Jour;
use App\Entity\Salle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('salle', EntityType::class, [
                'class'=>Salle::class,
                'choice_label'=>'name',
            ])
            ->add('jour', EntityType::class, [
                'class'=>Jour::class,
                'choice_label'=>'jour',
            ])
            ->add('horaire', EntityType::class, [
                'class'=>Horaire::class,
                'choice_label'=>'horaire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
