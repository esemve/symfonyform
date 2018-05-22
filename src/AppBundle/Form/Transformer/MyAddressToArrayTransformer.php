<?php

namespace AppBundle\Form\Transformer;

use AppBundle\Entity\MyAddress;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MyAddressToArrayTransformer implements DataTransformerInterface
{
    /**
     * @param MyAddress $myAddress
     * @return array
     */
    public function transform($myAddress)
    {
        return [
            'zip' => $myAddress->getZip(),
            'city' => $myAddress->getCity(),
            'address' => $myAddress->getAddress(),
        ];
    }

    /**
     * @param array $dataArray
     * @return MyAddress
     */
    public function reverseTransform($dataArray)
    {
        $myAddress = new MyAddress();
        $myAddress->setZip($dataArray['zip']);
        $myAddress->setCity($dataArray['city']);
        $myAddress->setAddress($dataArray['address']);

        return $myAddress;
    }

}