<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Time implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// MySQL TIME format: 'HH:MM:SS'
		$format = 'H:i:s';
		$d = \DateTime::createFromFormat($format, $value);
		return $d && $d->format($format) === $value;
	}

	public function getErrorMessage(): string {
		return "The field must be a valid time in the format 'HH:MM:SS'.";
	}
}
