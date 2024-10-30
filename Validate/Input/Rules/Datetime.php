<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Datetime implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// MySQL DATETIME format: 'YYYY-MM-DD HH:MM:SS'
		$format = 'Y-m-d H:i:s';
		$d = \DateTime::createFromFormat($format, $value);
		return $d && $d->format($format) === $value;
	}

	public function getErrorMessage(): string {
		return "The field must be a valid datetime in the format 'YYYY-MM-DD HH:MM:SS'.";
	}
}