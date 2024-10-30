<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class Alpha implements RuleInterface
{
    public function validate(mixed $value, mixed $parameters = null): bool {
 	   return ctype_alpha($value);
    }

    public function getErrorMessage(): string {
 	   return "The field must contain only alphabetic characters.";
    }
}
