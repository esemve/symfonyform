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
    protected $defaultStopWords = [
        'cica',
        '  ',
    ];

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

        $resolver->setDefault('stop_words', $this->defaultStopWords);
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->stopWords = $options['stop_words'];

        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use($options) {
            $this->validate($event, $options);
        });
    }

    protected function validate(FormEvent $event, array $options): void
    {
        $data = $event->getData();

        foreach ($options['stop_words'] as $stopWord) {
            if (gettype($data) === 'string') {
                $data = [$data];
            }

            if ($data instanceof \Traversable) {
                foreach ($data as $value) {
                    if (gettype($data) == 'string' && mb_strpos($data, $stopWord) !== false) {
                        $event->getForm()->addError(new FormError("It contains stopword: '$stopWord'"));
                    }
                }
            }
        }
    }
}