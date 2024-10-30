<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class MaxSize implements RuleInterface
{
	public function validate($value, $parameters = null): bool {
		if (empty($value)) return true; // Skip if empty (handled by nullable)

		$maxSizeKB = (int) $parameters; // Convert max size to integer KB

		// Check the file size
		return filesize($value) / 1024 <= $maxSizeKB; // Convert bytes to KB
	}

	public function getErrorMessage(): string {
		return "The uploaded file must not exceed {$parameters} KB.";
	}
}
