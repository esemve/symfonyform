<?php

namespace AppBundle\Form;

use AppBundle\Entity\MyAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class AddressFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('zip',TextType::class, [
            'label' => 'Irsz.',
            'data' => $options['data']->getZip() ?? null,
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

        $builder->add('city',TextType::class, [
            'label' => 'Város',
            'data' => $options['data']->getCity() ?? null,
            'translation_domain' => false,
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        $builder->add('address',TextType::class, [
            'label' => 'Utca, házszám',
            'data' => $options['data']->getAddress() ?? null,
            'translation_domain' => false,
            'constraints' => [
                new NotBlank(),
            ],
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        parent::buildView($view, $form, $options);

        if (!$view->parent) {
            $view->children[] = $form->getConfig()->getFormFactory()->create(SubmitType::class)->createView($view);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MyAddress::class,
        ));
    }

    public function getParent()
    {
        return FormType::class;
    }
}