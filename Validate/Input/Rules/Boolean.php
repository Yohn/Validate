<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Boolean implements RuleInterface
{
    public function validate(mixed $value, mixed $parameters = null): bool {
 	   return in_array($value, [true, false, 1, 0, '1', '0', 'yes', 'no'], true);
    }

    public function getErrorMessage(): string {
 	   return "The field must be a valid boolean value.";
    }
}
