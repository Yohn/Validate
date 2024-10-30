<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;
use Yohns\Validate\Input\Rules\Mime;

class Image implements RuleInterface
{
	public function validate($value, $parameters = null): bool {
		if (empty($value)) return true; // Skip if empty (handled by nullable)
		// If the MIME types are passed (via the Mime rule), check them
		if ($parameters) {
			$mimeRule = new Mime();
			return $mimeRule->validate($value, $parameters);
		}
		// If no parameters are passed, default to just checking it's an image
		$fileMimeType = mime_content_type($value);
		return strpos($fileMimeType, 'image/') === 0; // Must start with 'image/'
	}

	public function getErrorMessage(): string {
		return "The uploaded file must be a valid image file.";
	}
}
