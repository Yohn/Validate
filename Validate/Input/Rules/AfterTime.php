<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class AfterTime implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// $parameters is the time to check against
		$time = \DateTime::createFromFormat('H:i:s', $value);
		$afterTime = \DateTime::createFromFormat('H:i:s', $parameters);

		return $time > $afterTime;
	}

	public function getErrorMessage(): string {
		return "The time must be after {$parameters}.";
	}
}