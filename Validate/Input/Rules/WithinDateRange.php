<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;


class WithinDateRange implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Expecting $parameters as 'startDate,endDate' in 'Y-m-d' format
		[$startDate, $endDate] = explode(',', $parameters);
		$date = \DateTime::createFromFormat('Y-m-d', $value);
		$start = \DateTime::createFromFormat('Y-m-d', $startDate);
		$end = \DateTime::createFromFormat('Y-m-d', $endDate);

		return $date >= $start && $date <= $end;
	}

	public function getErrorMessage(): string {
		return "The date must be between {$parameters}.";
	}
}