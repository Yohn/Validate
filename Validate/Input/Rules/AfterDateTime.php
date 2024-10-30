<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class AfterDateTime implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Validate that both the value and the parameters follow 'Y-m-d H:i:s' format
		$dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $value);
		$afterDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $parameters);

		// Ensure both datetimes are valid and the value is after the specified datetime
		return $dateTime && $afterDateTime && $dateTime > $afterDateTime;
	}

	public function getErrorMessage(): string {
		return "The datetime must be after {$parameters}.";
	}
}
