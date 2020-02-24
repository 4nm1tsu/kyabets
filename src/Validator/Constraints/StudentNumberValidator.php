<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class StudentNumberValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value) {
            return;
        }
        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (preg_match('/(^.{8,}$)|(^.{0,6}$)|(^(?!46))(.{7}$)/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{value}}', $value)
                          ->addViolation();
        }
    }
}
