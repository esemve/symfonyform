<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressFormType extends FormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('zip',TextType::class, [
            'label' => 'Irsz.',
            'data' => $options['data']['zip'] ?? null,
            'translation_domain' => false,
        ]);

        $builder->add('city',TextType::class, [
            'label' => 'Város',
            'data' => $options['data']['city'] ?? null,
            'translation_domain' => false,
        ]);

        $builder->add('address',TextType::class, [
            'label' => 'Utca, házszám',
            'data' => $options['data']['address'] ?? null,
            'translation_domain' => false,
        ]);
    }

    public function getParent()
    {
        return FormType::class;
    }
}