<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Date implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// MySQL DATE format: 'YYYY-MM-DD'
		$format = 'Y-m-d';
		$d = \DateTime::createFromFormat($format, $value);
		return $d && $d->format($format) === $value;
	}

	public function getErrorMessage(): string {
		return "The field must be a valid date in the format 'YYYY-MM-DD'.";
	}
}