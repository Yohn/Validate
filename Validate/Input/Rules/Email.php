<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class EmailRule implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
	}

	public function getErrorMessage(): string {
		return "The field must be a valid email address.";
	}
}
