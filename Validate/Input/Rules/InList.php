<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class InList implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		$allowedValues = explode(',', $parameters);
		return in_array($value, $allowedValues);
	}

	public function getErrorMessage(): string {
		return "The selected value is invalid.";
	}
}
