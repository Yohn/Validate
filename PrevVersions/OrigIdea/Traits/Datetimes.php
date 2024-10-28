<?php

namespace Yohns\Validate\Traits;

use Yohns\Validate\Exception\ValidationException;

trait DatetimesTrait
{
	public static function validateBlobSize(string $blobData, string $blobType, array $rules): void
	{
		if (!isset($rules[$blobType])) {
			throw new ValidationException("Invalid Blob type: $blobType.");
		}
		$maxLength = $rules[$blobType]['max_length'];
		$blobLength = strlen($blobData);
		if ($blobLength > $maxLength) {
			throw new ValidationException("Blob data exceeds the maximum allowed length of $maxLength bytes for $blobType.");
		}
	}
}