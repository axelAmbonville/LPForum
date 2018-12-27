<?php

namespace App\Form;

use App\Entity\Topics;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TopicsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('topic_title')
            ->add('topic_content')
            ->add('topic_solved')
            ->add('topic_enabled')
            ->add('topics_cat', EntityType::class, ['choice_label' => 'catTitle', 'class' => Categories::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Topics::class,
        ]);
    }
}
