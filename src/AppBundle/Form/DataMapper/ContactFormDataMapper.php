<?php

namespace AppBundle\Form\DataMapper;

use AppBundle\Entity\AddressBook;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception;
use Symfony\Component\Form\FormInterface;

class ContactFormDataMapper implements DataMapperInterface
{
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

        /** @var AddressBook $data */
        $forms['name']->setData($data->getName());
        $forms['address']->setData([
            'zip' => $data->getZip(),
            'city' => $data->getCity(),
            'address' => $data->getAddress()
        ]);

        $forms['phone']->setData($data->getPhone());
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

        /** @var AddressBook $data */
        $data->setPhone($forms['phone']->getData());
        $data->setName($forms['name']->getData());
        $data->setZip($forms['address']->getNormData()['zip']);
        $data->setCity($forms['address']->getNormData()['city']);
        $data->setAddress($forms['address']->getNormData()['address']);
    }
}