<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class BeforeDate implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// $parameters is the date to check against
		$date = \DateTime::createFromFormat('Y-m-d', $value);
		$beforeDate = \DateTime::createFromFormat('Y-m-d', $parameters);

		return $date < $beforeDate;
	}

	public function getErrorMessage(): string {
		return "The date must be before {$parameters}.";
	}
}