<?php

namespace AppBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EvilValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (strpos($value, $constraint->evilNumber)!==false)
        {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
