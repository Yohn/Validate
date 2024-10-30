<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;
/**
 * Will probably need to modify this to work with the following format..
 * confirmed(otherfieldname)
 * //# Validates that the field matches another field (e.g., password confirmation)
 * //!			 Format: confirmed(otherfieldname)
 */
class Confirmed implements RuleInterface
{
	protected $confirmationField;

	public function __construct($confirmationField){
		$this->confirmationField = $confirmationField;
	}

	public function validate(mixed $value, mixed $parameters = null): bool {
		return $value === $parameters[$this->confirmationField];
	}

	public function getErrorMessage(): string {
		return "The field does not match the confirmation field.";
	}
}

/*
! I told AI that I needed to make this rule without the construct method and it gave me the following
! 	not sure if this wil work..
class Confirmed implements RuleInterface
{
	// Pass the entire input dataset in the $parameters argument, along with the field to confirm
	public function validate(mixed $value, mixed $parameters = null): bool {
		// Ensure $parameters includes the full dataset and the confirmation field name
		if (!is_array($parameters) || !isset($parameters['field'])) {
			return false; // Invalid parameters or missing confirmation field
		}

		// Get the field name to confirm and the full dataset
		$confirmationField = $parameters['field'];
		$dataSet = $parameters['data'];

		// Check if the confirmation field exists in the dataset
		if (!isset($dataSet[$confirmationField])) {
			return false; // Confirmation field not present in the data
		}

		// Compare the value with the corresponding confirmation field value
		return $value === $dataSet[$confirmationField];
	}

	public function getErrorMessage(): string {
		return "The field does not match the confirmation field.";
	}
}
	*/