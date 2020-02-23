<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class StudentNumber extends Constraint
{
    public $message = '"{{value}}"は46xxxxxの形式ではありません';
}
