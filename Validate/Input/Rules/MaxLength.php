<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class MaxLength implements RuleInterface
{
	public function validate($value, $parameters = null): bool {
		return strlen($value) <= $parameters;
	}

	public function getErrorMessage(): string {
		return "The field must not exceed {$parameters} characters.";
	}
}
