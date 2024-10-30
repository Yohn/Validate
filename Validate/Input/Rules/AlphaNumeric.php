<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class AlphaNumeric implements RuleInterface
{
    public function validate(mixed $value, mixed $parameters = null): bool {
 	   return ctype_alnum($value);
    }

    public function getErrorMessage(): string {
 	   return "The field must contain only alphanumeric characters.";
    }
}
