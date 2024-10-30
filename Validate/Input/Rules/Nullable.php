<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class NullableRule implements RuleInterface
{
	public function validate($value, $parameters = null): bool {
		// If the field is null or empty, it's valid (skips further validation).
		return empty($value);
	}

	public function getErrorMessage(): string {
		return ""; // No error for nullable; it allows null.
	}
}