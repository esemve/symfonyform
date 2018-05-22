<?php

namespace AppBundle\Form;

use AppBundle\Form\DataMapper\ContactFormDataMapper;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends FormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $this->buildAddressBox($builder, $options);
        $this->buildPhoneBox($builder, $options);
        $this->buildNameBox($builder, $options);
        $this->buildSubmitBox($builder, $options);

        $builder->setDataMapper(new ContactFormDataMapper());
    }

    public function getParent()
    {
        return FormType::class;
    }

    protected function buildAddressBox(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('address', AddressFormType::class, [
            'without_submit' => true
        ]);
    }

    protected function buildPhoneBox(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('phone', PhoneFormType::class);
    }

    protected function buildNameBox(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('name',TextType::class, [
            'label' => 'Név',
            'translation_domain' => false,
            'constraints' => [
                new NotBlank(),
            ],
        ]);
    }

    protected function buildSubmitBox(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('submit',SubmitType::class, [
            'label' => 'Mentés'
        ]);
    }
}