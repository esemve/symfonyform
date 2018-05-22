<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class AddressFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $this->buildZipBox($builder, $options);
        $this->buildCityBox($builder, $options);
        $this->buildAddressBox($builder, $options);

        if ($options['without_submit']===false) {
            $builder->add('submit', SubmitType::class, [
                'label' => 'Mentés'
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'without_submit' => false
        ));
    }

    public function getParent()
    {
        return FormType::class;
    }

    protected function buildZipBox(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('zip',TextType::class, [
            'label' => 'Irsz.',
            'translation_domain' => false,
            'constraints' => [
                new NotBlank(),
                new Range([
                    'min' => 1000,
                    'max' => 9999,
                    'minMessage' => 'Az irányítószám pontosan 4 karakter hosszú',
                    'maxMessage' => 'Az irányítószám pontosan 4 karakter hosszú',
                ]),
            ],
        ]);
    }

    protected function buildCityBox(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('city',TextType::class, [
            'label' => 'Város',
            'translation_domain' => false,
            'constraints' => [
                new NotBlank(),
            ],
        ]);
    }

    protected function buildAddressBox(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('address',TextType::class, [
            'label' => 'Utca, házszám',
            'translation_domain' => false,
            'constraints' => [
                new NotBlank(),
            ],
        ]);
    }
}