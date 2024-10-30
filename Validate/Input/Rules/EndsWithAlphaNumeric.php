<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class EndsWith implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Ensure the value is a string and the parameters are set
		if (!is_string($value) || empty($parameters)) {
			return false;
		}

		// Get the last character of the string
		$lastChar = $value[strlen($value) - 1];

		// Handle various parameter cases (alphanumeric, alpha, numeric, custom characters)
		switch ($parameters) {
			case 'alphanumeric':
				return ctype_alnum($lastChar); // Check if alphanumeric (A-Z, a-z, 0-9)
			case 'alpha':
				return ctype_alpha($lastChar); // Check if alphabetic (A-Z, a-z)
			case 'numeric':
				return ctype_digit($lastChar); // Check if numeric (0-9)
			default:
				// If custom characters are provided, check if the last character is in the list
				return strpos($parameters, $lastChar) !== false;
		}
	}

	public function getErrorMessage(): string {
		return "The field must end with the specified characters.";
	}
}
