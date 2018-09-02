<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisibilityChoiceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->addAllowedTypes('visibility_for', 'string');
        $resolver->setRequired('visibility_for', true);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $fieldName = $options['visibility_for'];

        $builder->add('visibility', ChoiceType::class, [
            'choices' => [
                'Privát' => 'private',
                'Barátok' => 'friends',
                'Barátok barátai' => 'friends_of_friends',
                'Mindenki' => 'public',
            ],
        ]);
    }
}