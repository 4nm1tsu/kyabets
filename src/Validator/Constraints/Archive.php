<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Archive extends Constraint
{
    public $message = '"{{value}}"は有効なファイルタイプではありません';
}
