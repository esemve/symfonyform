<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class PhoneFormType extends AbstractType implements DataMapperInterface
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $this->buildPhone1Box($builder, $options);
        $this->buildPhone2Box($builder, $options);

        $builder->setDataMapper($this);
    }

    protected function buildPhone1Box(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('phone1',ChoiceType::class, [
            'label' => 'Telefonszám',
            'translation_domain' => false,
            'choice_translation_domain' => false,
            'choices' => [
                '20' => '3620',
                '30' => '3630',
                '70' => '3670',
            ],
        ]);
    }

    protected function buildPhone2Box(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('phone2',TextType::class, [
            'label' => 'Telefonszám',
            'translation_domain' => false,
            'constraints' => [
                new NotBlank(),
                new Range([
                    'min' => 1000000,
                    'max' => 9999999,
                ]),
            ],
        ]);
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

        list($phone1, $phone2) = !empty($data) ? explode('/', $data, 2) : [null, null];

        $forms['phone1']->setData($phone1);
        $forms['phone2']->setData($phone2);
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

        $data = $forms['phone1']->getData().'/'.$forms['phone2']->getData();
    }
}