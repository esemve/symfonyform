<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactFormType extends FormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('addr', AddressFormType::class);

        $builder->add('phone1',ChoiceType::class, [
            'label' => 'Telefonszám',
            'data' => $options['data']['phone1'],
            'translation_domain' => false,
            'choice_translation_domain' => false,
            'choices' => [
                '3620' => '20',
                '3630' => '30',
                '3670' => '70',
            ],
        ]);

        $builder->add('phone2',TextType::class, [
            'label' => 'Telefonszám',
            'data' => $options['data']['phone2'],
            'translation_domain' => false,
        ]);

        $builder->add('name',TextType::class, [
            'label' => 'Név',
            'data' => $options['data']['name'],
            'translation_domain' => false,
        ]);
    }

    public function getParent()
    {
        return FormType::class;
    }
}