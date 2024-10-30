<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class FloatRule implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		if (!is_numeric($value) || floatval($value) != $value) {
			return false;
		}
		if ($parameters) {
			if (preg_match('/<(\d+(\.\d+)?)/', $parameters, $matches)) {
				if ($value >= $matches[1]) return false;
			}
			if (preg_match('/>(\d+(\.\d+)?)/', $parameters, $matches)) {
				if ($value <= $matches[1]) return false;
			}
			//! was going to be a min and max, but we should use between for that.
			//if (preg_match('/(\d+(\.\d+)?)><(\d+(\.\d+)?)/', $parameters, $matches)) {
			//	if ($value <= $matches[1] || $value >= $matches[3]) return false;
			//}
		}
		return true;
	}

	public function getErrorMessage(): string {
		return "The field must be a float within the specified range.";
	}
}