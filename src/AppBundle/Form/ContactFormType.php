<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class ContactFormType extends FormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('address', AddressFormType::class, ['data' => $options['data']]);

        $builder->add('phone1',ChoiceType::class, [
            'label' => 'Telefonszám',
            'data' => $options['data']['phone1'],
            'translation_domain' => false,
            'choice_translation_domain' => false,
            'choices' => [
                '20' => '3620',
                '30' => '3630',
                '70' => '3670',
            ],
        ]);

        $builder->add('phone2',TextType::class, [
            'label' => 'Telefonszám',
            'data' => $options['data']['phone2'],
            'translation_domain' => false,
            'constraints' => [
                new NotBlank(),
                new Range([
                    'min' => 1000000,
                    'max' => 9999999,
                ]),
            ],
        ]);

        $builder->add('name',TextType::class, [
            'label' => 'Név',
            'data' => $options['data']['name'],
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
        $resolver->setDefaults([
            'allow_extra_fields' => true,
        ]);
    }

    public function getParent()
    {
        return FormType::class;
    }
}