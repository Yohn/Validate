<?php

namespace Yohns\Validate\Input;

interface RuleInterface
{
	public function validate($value, $parameters = null): bool;

	public function getErrorMessage(): string;
}
