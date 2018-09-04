<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisibilityChoiceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('choices', [
            'Privát' => 'private',
            'Barátok' => 'friends',
            'Barátok barátai' => 'friends_of_friends',
            'Mindenki' => 'public',
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}