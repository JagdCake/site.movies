<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('directors', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => '0',
                'prototype_data' => '',
            ])
            ->add('top_actors', CollectionType::class, [
                'entry_type' => TextType::class,
                'data' => [
                    '0' => '',
                    '1' => '',
                ],
            ])
            ->add('my_rating', ChoiceType::class, [
                'choices' => [
                    'Bad Eggplant' => 'Bad Eggplant',
                    'Decent Carrot' => 'Decent Carrot',
                    'Good Tomato' => 'Good Tomato',
                    'Great Onion' => 'Great Onion',
                    'Amazing Savory' => 'Amazing Savory',
                    'Sublime Lettuce' => 'Sublime Lettuce',
                ],
                'preferred_choices' => ['Great Onion'],
            ])
            ->add('watched_on')
            ->add('discussion');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
