<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imdb_id')
            ->add('title')
            ->add('year_of_release')
            ->add('runtime')
            ->add('genre')
            ->add('imdb_rating')
            ->add('directors')
            ->add('top_actors')
            ->add('my_rating')
            ->add('watched_on')
            ->add('discussion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
