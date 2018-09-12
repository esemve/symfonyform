<?php

declare(strict_types=1);

namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HintTypeExtension extends AbstractTypeExtension
{
    public function getExtendedType(): string
    {
        return FormType::class;
    }

    public function configureOptions(OptionsResolver $options): void
    {
        parent::configureOptions($options);

        $options->setDefault('hint', '');
        $options->setAllowedTypes('hint', ['string']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        if (is_string($options['hint'])) {
            $view->vars['label_attr'] = is_array($view->vars['label_attr']) ? $view->vars['label_attr'] : [];
            $view->vars['label_attr']['title'] = $options['hint'];
        }
    }
}