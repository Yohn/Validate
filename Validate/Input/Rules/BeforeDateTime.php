<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class BeforeDateTime implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Validate that both the value and the parameters follow 'Y-m-d H:i:s' format
		$dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $value);
		$beforeDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $parameters);

		// Ensure both datetimes are valid and the value is before the specified datetime
		return $dateTime && $beforeDateTime && $dateTime < $beforeDateTime;
	}

	public function getErrorMessage(): string {
		return "The datetime must be before {$parameters}.";
	}
}