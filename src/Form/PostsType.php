<?php

namespace App\Form;

use App\Entity\Posts;
use App\Entity\Topics;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('post_content')
            ->add('post_enabled')
            ->add('posts_author', EntityType::class, ['choice_label' => 'UserPseudo', 'class' => Users::class])
            ->add('posts_topic', EntityType::class, ['choice_label' => 'TopicTitle', 'class' => Topics::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}
