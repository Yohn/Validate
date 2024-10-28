<?php

namespace Yohns\Validate\Processors;

use Exception;

/**
 * Class DataTypeException
 *
 * Custom exception class that extends the base Exception class.
 * Used for handling validation errors in a structured manner.
 *
 * @package Yohns\Validate\Processors
 */
class DataTypeException extends Exception
{
	/**
	 * DataTypeException constructor.
	 *
	 * Initializes a new instance of the DataTypeException class.
	 *
	 * @param string $message The error message to be displayed.
	 * @param int $code The error code (optional, defaults to 0).
	 * @param Exception|null $previous The previous exception used for exception chaining (optional).
	 */
	public function __construct(string $message, int $code = 0, ?Exception $previous = null)
	{
		// Calls the parent constructor to create the Exception with the specified message, code, and previous exception.
		parent::__construct($message, $code, $previous);
	}
}