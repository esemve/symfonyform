<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressForm extends FormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('zip',TextType::class, [
            'label' => 'Irsz.',
            'data' => $options['data']['zip'],
            'translation_domain' => false,
        ]);

        $builder->add('city',TextType::class, [
            'label' => 'Város',
            'data' => $options['data']['city'],
            'translation_domain' => false,
        ]);

        $builder->add('address',TextType::class, [
            'label' => 'Utca, házszám',
            'data' => $options['data']['address'],
            'translation_domain' => false,
        ]);
    }

    public function getParent()
    {
        return FormType::class;
    }
}