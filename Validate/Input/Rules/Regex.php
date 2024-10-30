<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Regex implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		return preg_match($parameters, $value) === 1;
	}

	public function getErrorMessage(): string {
		return "The field format is invalid.";
	}
}
