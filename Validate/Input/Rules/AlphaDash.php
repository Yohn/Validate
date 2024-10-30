<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class AlphaDash implements RuleInterface
{
    public function validate(mixed $value, mixed $parameters = null): bool {
 	   return preg_match('/^[a-zA-Z0-9_-]+$/', $value);
    }

    public function getErrorMessage(): string {
 	   return "The field must contain only letters, numbers, dashes, and underscores.";
    }
}
