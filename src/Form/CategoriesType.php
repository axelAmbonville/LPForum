<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Sections;
use App\Repository\SectionsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('cat_title')
            ->add('cat_subtitle')
            ->add('cat_enabled')
            ->add('cat_section', EntityType::class, ['choice_label' => 'secTitle', 'class' => Sections::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
