<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class AfterDate implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// $parameters is the date to check against
		$date = \DateTime::createFromFormat('Y-m-d', $value);
		$afterDate = \DateTime::createFromFormat('Y-m-d', $parameters);

		return $date > $afterDate;
	}

	public function getErrorMessage(): string {
		return "The date must be after {$parameters}.";
	}
}