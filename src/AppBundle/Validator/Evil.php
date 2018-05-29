<?php

namespace AppBundle\Validator;

use Symfony\Component\Validator\Constraint;

class Evil extends Constraint
{
    public $evilNumber = '777';

    public $message = 'Ez a gonosz száma!';
}

