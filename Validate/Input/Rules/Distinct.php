<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Distinct implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		return count($value) === count(array_unique($value));
	}

	public function getErrorMessage(): string {
		return "The field must contain unique values.";
	}
}
