<?php
namespace Yohns\Utils\Validate;

class ValException extends \InvalidArgumentException {
	private $context;
	private $errorType;

	public function __construct(
		string $message,
		string $errorType,
		array $context = [],
		int $code = 0,
		?Throwable $previous = null
	) {
		$this->context = $context;
		$this->errorType = $errorType;

		// Format message with context
		$formattedMessage = preg_replace_callback('/\{(\w+)\}/', function($matches) use ($context) {
			return $context[$matches[1]] ?? $matches[0];
		}, $message);

		parent::__construct($formattedMessage, $code, $previous);
	}

	public function getContext(): array {
		return $this->context;
	}

	public function getErrorType(): string {
		return $this->errorType;
	}
}