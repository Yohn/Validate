<?php

namespace Yohns\Validate\Traits;

use Yohns\Validate\Exception\ValidationException;

/**
 * Trait BlobTrait
 *
 * This trait provides functionality for validating the size of blob data.
 * It includes a method to check if the size of a given blob data does not exceed
 * the defined maximum size based on its type.
 *
 * This ensures that blob data adheres to storage limitations and maintains
 * data integrity within an application.
 */
trait BlobTrait
{
	/**
	 * Validates the size of the given blob data against predefined rules.
	 *
	 * This method checks whether the provided blob type is valid and whether
	 * the length of the blob data exceeds the maximum allowed length.
	 * If either check fails, a ValidationException is thrown with a descriptive message.
	 *
	 * @param string $blobData The blob data to validate.
	 * @param string $blobType The type of the blob data, which determines the validation rules.
	 * @param array $rules An associative array of rules where the keys are blob types
	 *  and the values are associative arrays with validation parameters
	 *  such as 'max_length'.
	 *
	 * @return void This function does not return a value but will throw
	 *  a ValidationException if validation fails.
	 *
	 * @throws ValidationException if the blob type is invalid or if the blob data exceeds
	 *  the maximum allowed length for the specified type.
	 */
	public static function validateBlobSize(string $blobData, string $blobType, array $rules): bool
	{
		if (!isset($rules[$blobType])) {
			return false;
			//throw new ValidationException("Invalid Blob type: $blobType.");
		}
		$maxLength = $rules[$blobType]['max_length'];
		$blobLength = strlen($blobData);
		if ($blobLength > $maxLength) {
			return false;
			///throw new ValidationException("Blob data exceeds the maximum allowed length of $maxLength bytes for $blobType.");
		}
		return true;
	}
}