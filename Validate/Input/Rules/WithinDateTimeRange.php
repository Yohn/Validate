<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

/**
 * Class WithinDateTimeRange
 *
 * This class implements the RuleInterface to validate whether a given datetime value
 * lies within a specified range (start and end). It is part of the validation rules
 * used in the input validation process.
 */
class WithinDateTimeRange implements RuleInterface
{
	/**
	 * Validates if the given datetime value falls within the specified range.
	 *
	 * @param mixed $value The value to validate, expected to be a datetime string in 'Y-m-d H:i:s' format.
	 * @param mixed $parameters Comma-separated string containing the start and end datetime for the range.
	 *
	 * @return bool Returns true if the value is within the specified datetime range; otherwise, false.
	 */
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Expecting $parameters as 'startDateTime,endDateTime' in 'Y-m-d H:i:s' format
		[$startDateTime, $endDateTime] = explode(',', $parameters);
		$dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $value);
		$start = \DateTime::createFromFormat('Y-m-d H:i:s', $startDateTime);
		$end = \DateTime::createFromFormat('Y-m-d H:i:s', $endDateTime);

		// Returns true if $dateTime is greater than or equal to $start
		// and less than or equal to $end
		return $dateTime >= $start && $dateTime <= $end;
	}

	/**
	 * Gets the error message to be displayed when validation fails.
	 *
	 * @return string The error message indicating that the datetime must be within the specified range.
	 */
	public function getErrorMessage(): string {
		return "The datetime must be between {$parameters}.";
	}
}
