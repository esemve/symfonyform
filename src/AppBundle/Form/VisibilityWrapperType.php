<?php

declare(strict_types=1);

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisibilityWrapperType extends AbstractType implements DataMapperInterface
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('inner_type');
        $resolver->setAllowedTypes('inner_type', ['string']);
        
        $resolver->setDefault('inner_name', 'value');
        $resolver->setAllowedTypes('inner_name', ['string']);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $innerName = $options['inner_name'];
        $innerType = $options['inner_type'];
        $innerOptions = $options;

        unset($innerOptions['inner_name']);
        unset($innerOptions['inner_type']);

        if ($innerName === 'visibility') {
            throw new \LogicException('Nope.');
        }
        
        $builder->add($innerName, $innerType, $innerOptions);

        $builder->add('visibility', VisibilityChoiceType::class);

        $builder->setDataMapper($this);
    }

    /**
     * Maps properties of some data to a list of forms.
     *
     * @param mixed $data Structured data
     * @param FormInterface[]|\Traversable $forms A list of {@link FormInterface} instances
     *
     * @throws Exception\UnexpectedTypeException if the type of the data parameter is not supported
     */
    public function mapDataToForms($data, $forms)
    {
        $forms = iterator_to_array($forms);

        $forms['value']->setData($data);
    }

    /**
     * Maps the data of a list of forms into the properties of some data.
     *
     * @param FormInterface[]|\Traversable $forms A list of {@link FormInterface} instances
     * @param mixed $data Structured data
     *
     * @throws Exception\UnexpectedTypeException if the type of the data parameter is not supported
     */
    public function mapFormsToData($forms, &$data)
    {
        $forms = iterator_to_array($forms);

        $data = $forms['value']->getData();
    }
}