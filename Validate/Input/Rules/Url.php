<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Url implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		return filter_var($value, FILTER_VALIDATE_URL) !== false;
	}

	public function getErrorMessage(): string {
		return "The field must be a valid URL.";
	}
}
