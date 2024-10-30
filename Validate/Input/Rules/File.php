<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class File implements RuleInterface
{
	public function validate($value, $parameters = null): bool {
		// If the field is nullable and empty, it's valid
		if (empty($value)) return true;
		// Extract MIME types from the parameters (if any)
		$validMimeTypes = $parameters ? explode(',', $parameters) : null;
		// Get the actual MIME type of the uploaded file
		$fileMimeType = mime_content_type($value);
		// If no MIME types are provided, we accept all files
		if ($validMimeTypes === null) {
			return is_file($value);
		}
		// If MIME types are provided, validate against them
		return in_array($fileMimeType, $validMimeTypes);
	}

	public function getErrorMessage(): string {
		return "The uploaded file type is not allowed.";
	}
}
