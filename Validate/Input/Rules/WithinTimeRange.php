<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class WithinTimeRange implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Expecting $parameters as 'startTime,endTime' in 'H:i:s' format
		[$startTime, $endTime] = explode(',', $parameters);
		$time = \DateTime::createFromFormat('H:i:s', $value);
		$start = \DateTime::createFromFormat('H:i:s', $startTime);
		$end = \DateTime::createFromFormat('H:i:s', $endTime);

		return $time >= $start && $time <= $end;
	}

	public function getErrorMessage(): string {
		return "The time must be between {$parameters}.";
	}
}