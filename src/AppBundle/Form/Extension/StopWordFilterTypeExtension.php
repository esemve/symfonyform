<?php

declare(strict_types=1);

namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


class StopWordFilterTypeExtension extends AbstractTypeExtension
{
    protected $defaultStopWords = [];

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

        $resolver->setDefault('stop_words_enabled', true);
        $resolver->setAllowedTypes('stop_words_enabled', ['boolean']);
        $resolver->setDefault('stop_words', $this->defaultStopWords);
        $resolver->setAllowedTypes('stop_words', ['iterable']);
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use($options) {
            $this->validate($event, $options);
        });
    }

    protected function validate(FormEvent $event, array $options): void
    {
        if ($options['stop_words_enabled']) {
            return;
        }

        $data = $event->getData();

        foreach ($options['stop_words'] as $stopWord) {
            if (gettype($data) === 'string') {
                $data = [$data];
            }

            if (is_iterable($data)) {
                foreach ($data as $value) {
                    if (gettype($value) == 'string' && mb_strpos($value, $stopWord) !== false) {
                        $event->getForm()->addError(new FormError("It contains stopword: '$stopWord'"));
                    }
                }
            }
        }
    }
}