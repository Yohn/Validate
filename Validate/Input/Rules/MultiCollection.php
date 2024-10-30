<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class MultiCollection implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Ensure that the value is an array
		if (!is_array($value)) {
			return false;
		}

		// Check each value in the array using SampleMultiCollection
		return SampleMultiCollection::check($value);
	}

	public function getErrorMessage(): string {
		return "One or more of the selected values are invalid.";
	}
}

/*
<?php

class SampleMultiCollection
{
	// Predefined valid values in the collection
	protected static array $validValues = ['value1', 'value2', 'value3', 'value4', 'value5'];

	public static function check(array $dataVal): bool {
		// Ensure all provided values are in the valid values array
		foreach ($dataVal as $val) {
			if (!in_array($val, self::$validValues)) {
				return false;
			}
		}
		return true;
	}
}
*/