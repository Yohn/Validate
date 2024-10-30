<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Json implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Validate that the value is a valid UTF-8 encoded JSON string
		if (!is_string($value)) {
			return false;
		}
		if(function_exists('json_validate')){
			return json_validate($value);
		} else {
			json_decode($value);
			return json_last_error() === JSON_ERROR_NONE;
		}
	}

	public function getErrorMessage(): string {
		return "The field must contain a valid JSON string.";
	}
}
