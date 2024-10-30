<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Age implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Validate that the date is a valid 'YYYY-MM-DD' format and calculate the age
		$dob = \DateTime::createFromFormat('Y-m-d', $value);
		if (!$dob) {
			return false;
		}
		$today = new \DateTime();
		$age = $today->diff($dob)->y;
		// $parameters is the minimum age required
		return $age >= $parameters;
	}

	public function getErrorMessage(): string {
		return "The field must represent an age of at least {$parameters} years.";
	}
}

/*
!---------------------------------------------

class Age implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Validate that the date is a valid 'YYYY-MM-DD' format
		$dob = \DateTime::createFromFormat('Y-m-d', $value);
		if (!$dob) {
			return false;
		}

		// Calculate the age
		$today = new \DateTime();
		$age = $today->diff($dob)->y;

		// Extract the operator and the age to compare (e.g., '<18', '>18', '=18')
		preg_match('/([<>]?=?)\s*(\d+)/', $parameters, $matches);
		$operator = $matches[1];
		$ageToCompare = (int) $matches[2];

		// Compare the age based on the operator
		switch ($operator) {
			case '<':
				return $age < $ageToCompare;
			case '>':
				return $age > $ageToCompare;
			case '=':
				return $age === $ageToCompare;
			case '<=':
				return $age <= $ageToCompare;
			case '>=':
				return $age >= $ageToCompare;
			default:
				return false;
		}
	}

	public function getErrorMessage(): string {
		return "The age does not meet the required condition.";
	}
}

!---------------------------------------------
class Age implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Validate that the date is in the 'YYYY-MM-DD' format
		$dob = \DateTime::createFromFormat('Y-m-d', $value);
		if (!$dob) {
			return false;
		}

		// Calculate the age
		$today = new \DateTime();
		$age = $today->diff($dob)->y;

		// Extract operator and age from parameters, defaulting to '>=' if no operator is provided
		preg_match('/([<>]?=?)?\s*(\d+)/', $parameters, $matches);

		$operator = $matches[1] ?? '>=';
		$ageToCompare = (int) $matches[2];

		// Compare the age based on the operator
		switch ($operator) {
			case '<':
				return $age < $ageToCompare;
			case '>':
				return $age > $ageToCompare;
			case '=':
				return $age === $ageToCompare;
			case '<=':
				return $age <= $ageToCompare;
			case '>=':
				return $age >= $ageToCompare;
			default:
				return false;
		}
	}

	public function getErrorMessage(): string {
		return "The age does not meet the required condition.";
	}
}

!--------------------------------------------- Last version received
namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Age implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Validate that the date is in the 'YYYY-MM-DD' format
		$dob = \DateTime::createFromFormat('Y-m-d', $value);
		if (!$dob) {
			return false;
		}

		// Calculate the age
		$today = new \DateTime();
		$age = $today->diff($dob)->y;

		// Check if parameters are provided
		if (empty($parameters)) {
			return false; // Fail validation if no parameters are provided
		}

		// Extract operator and age from parameters, defaulting to '>=' if no operator is provided
		preg_match('/([<>]?=?)?\s*(\d+)/', $parameters, $matches);

		if (empty($matches)) {
			return false; // Fail if no valid matches are found
		}

		$operator = $matches[1] ?? '>=';
		$ageToCompare = (int) ($matches[2] ?? 18); // Default to 18 if no age is provided

		// Compare the age based on the operator
		switch ($operator) {
			case '<':
				return $age < $ageToCompare;
			case '>':
				return $age > $ageToCompare;
			case '=':
				return $age === $ageToCompare;
			case '<=':
				return $age <= $ageToCompare;
			case '>=':
				return $age >= $ageToCompare;
			default:
				return false;
		}
	}

	public function getErrorMessage(): string {
		return "The age does not meet the required condition.";
	}
}*/