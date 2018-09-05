<?php

declare(strict_types=1);

namespace AppBundle\Form\DataMapper;

use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception;
use Symfony\Component\Form\FormInterface;

class VisibilityDataMapper implements DataMapperInterface
{
    public function mapDataToForms($data, $forms)
    {
        dump(func_get_args());
        throw new \BadMethodCallException();
    }

    public function mapFormsToData($forms, &$data)
    {
        dump(func_get_args());
        throw new \BadMethodCallException();
    }
}