<?php

namespace Yohns\Validate\Input\Rules;
use Yohns\Validate\Input\RuleInterface;

class Ip implements RuleInterface
{
	public function validate(mixed $value, mixed $parameters = null): bool {
		return filter_var($value, FILTER_VALIDATE_IP) !== false;
	}

	public function getErrorMessage(): string {
		return "The field must be a valid IP address.";
	}
}
