<?php

declare(strict_types=1);

namespace AppBundle\Form\Extension;

use AppBundle\Form\VisibilityChoiceType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisibilityTypeExtension extends AbstractTypeExtension
{
    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */

    public function getExtendedType(): string
    {
        return FormType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('visibility_enabled', true);
        $resolver->setAllowedTypes('visibility_enabled', ['boolean']);
    }


    // TODO
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        if ($options['compound'] && $options['visibility_enabled']) {

            $builder->add('visibility', ChoiceType::class, [
                'choices' => [
                    'Privát' => 'private',
                    'Barátok' => 'friends',
                    'Barátok barátai' => 'friends_of_friends',
                    'Mindenki' => 'public',
                ],
                'visibility_enabled' => false,
            ]);


        }
    }
}