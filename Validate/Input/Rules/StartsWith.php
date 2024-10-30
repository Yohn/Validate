<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class StartsWith implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Ensure the value is a string and the parameters are set
		if (!is_string($value) || empty($parameters)) {
			return false;
		}

		// Get the first character of the string
		$firstChar = $value[0];

		// Handle various parameter cases (alphanumeric, alpha, numeric, custom characters)
		switch ($parameters) {
			case 'alphanumeric':
				return ctype_alnum($firstChar); // Check if alphanumeric (A-Z, a-z, 0-9)
			case 'alpha':
				return ctype_alpha($firstChar); // Check if alphabetic (A-Z, a-z)
			case 'numeric':
				return ctype_digit($firstChar); // Check if numeric (0-9)
			default:
				// If custom characters are provided, check if the first character is in the list
				return strpos($parameters, $firstChar) !== false;
		}
	}

	public function getErrorMessage(): string {
		return "The field must start with the specified characters.";
	}
}
