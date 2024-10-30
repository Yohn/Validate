<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Year implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// MySQL YEAR format: 'YYYY'
		$format = 'Y';
		$d = \DateTime::createFromFormat($format, $value);
		return $d && $d->format($format) === $value;
	}

	public function getErrorMessage(): string {
		return "The field must be a valid year in the format 'YYYY'.";
	}

	public static function buildRule($rule) {

	}
}