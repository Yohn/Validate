<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class SingleCollection implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Validate that the single value exists in the Sample1Collection
		return Sample1Collection::check($value);
	}

	public function getErrorMessage(): string {
		return "The selected value is invalid.";
	}
}

/*
<?php

class Sample1Collection
{
	// Predefined valid values in the collection
	protected static array $validValues = ['option1', 'option2', 'option3'];

	public static function check(string $dataVal): bool {
		return in_array($dataVal, self::$validValues);
	}
}
*/