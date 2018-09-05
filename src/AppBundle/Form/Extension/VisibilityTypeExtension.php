<?php

declare(strict_types=1);

namespace AppBundle\Form\Extension;

use AppBundle\Form\EventListener\VisibilityEventListener;
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

        $resolver->setDefault('visibility_enabled', false);
        $resolver->setAllowedTypes('visibility_enabled', ['boolean']);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['visibility_enabled']) {
            $name = $builder->getName();
            $type = get_class($builder->getType()->getInnerType());
            $builder->addEventSubscriber(new VisibilityEventListener($name, $type, $options));
        }
    }
}