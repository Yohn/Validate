<?php

namespace Yohns\Validate\Processors;

use Yohns\Validate\Processors\DataTypeInterface;

class BlobHandler implements  DataTypeInterface {

	public function process(mixed $input, array $dataTypeSchema, array $rules): mixed {}

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

	private function checkBlob(string $input){

	}

	private function getBlobTypes(){
		if(self::$BlobMimeTypes === null){
			// see which file we're loading...$BlobMimeTypes
			self::$BlobMimeTypes = Config::getAll(self::$BlobMimeTypesFileName);
			if (self::$BlobMimeTypes === null) {
				self::$BlobMimeTypes = include __DIR__ . '/Rules/'.self::$BlobMimeTypesFileName.'.php';
			}
		} else {
			return self::$BlobMimeTypes;
		}
	}
}

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
