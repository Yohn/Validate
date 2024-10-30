<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Between implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Ensure the value and parameters are properly formatted
		if (!is_numeric($value) || !is_string($parameters)) {
			return false;
		}

		// Split the parameters into min and max values
		[$min, $max] = explode(',', $parameters);

		// Cast min, max, and value to float to handle floats/decimals
		$min = (float) $min;
		$max = (float) $max;
		$value = (float) $value;

		// Perform the comparison
		return $value >= $min && $value <= $max;
	}

	public function getErrorMessage(): string {
		return "The field value must be between {$parameters}.";
	}
}