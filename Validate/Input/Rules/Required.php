<?php

namespace Yohns\Validate\Input\Rules;

use Yohns\Validate\Input\RuleInterface;

class Required implements RuleInterface
{
	public function validate($value, $parameters = null): bool {
		return !empty($value);
	}

	public function getErrorMessage(): string {
		return "This field is required.";
	}
}
