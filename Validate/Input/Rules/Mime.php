<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class MimeRule implements RuleInterface
{
	public function validate($value, $parameters = null): bool {
		if (empty($value)) return true; // Skip if empty (handled by nullable)
		$validMimeTypes = explode(',', $parameters); // e.g. image/jpg,image/jpeg,image/png
		$fileMimeType = mime_content_type($value);
		return in_array($fileMimeType, $validMimeTypes);
	}

	public function getErrorMessage(): string {
			return "The uploaded file must be of a valid MIME type.";
	}
}
