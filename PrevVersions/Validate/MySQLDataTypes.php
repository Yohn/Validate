<?php

namespace Yohns\Utils\Validate;

use Yohns\Core\Config;

/**
 * This class handles validation of MySQL data types, ensuring that
 * the values conform to the specified MySQL type rules.
 */
class MySQLDataTypes {
	private $value;
	private $type;
	private $params;
	private static $types;
	private $unsigned = false;

	/**
	 * Constructor that initializes the value and type.
	 *
	 * @param mixed $value The value to validate.
	 * @param string $type The MySQL data type (e.g., INT, VARCHAR).
	 */
	public function __construct($value, string $type) {
		$this->value = $value;
		$this->parseType($type);
		self::$types = require 'ValRules-MySQLDataType.php';
	}

	/**
	 * Parses the provided data type string to determine its components.
	 *
	 * @param string $type The type string to parse (e.g., INT(11), VARCHAR(255)).
	 * @throws ValException If the type format is invalid.
	 * @return void
	 */
	private function parseType(string $type): void {
		if (preg_match('/^(\w+)(?:\((.*?)\))?$/', strtoupper($type), $matches)) {
			$this->type = $matches[1];
			$this->params = isset($matches[2]) ? array_map('trim', explode(',', $matches[2])) : [];

			if (in_array('UNSIGNED', array_map('strtoupper', $this->params))) {
				$this->unsigned = true;
				$this->params = array_filter($this->params, fn($param) =>
					strtoupper($param) !== 'UNSIGNED'
				);
			}
		} else {
			throw new ValException(
				"Invalid type format: {type}",
				'invalid_type_format',
				['type' => $type]
			);
		}
	}

	/**
	 * Validates the value against its data type.
	 *
	 * @throws ValException If the type is unknown or validation is not implemented.
	 * @return bool True if validation passes.
	 */
	public function validate(): bool {
		if (!isset(self::$types[$this->type])) {
			throw new ValException(
				"Unknown type: {type}",
				'unknown_type',
				['type' => $this->type]
			);
		}
		$typeInfo = self::$types[$this->type];
		if (isset($typeInfo['alias_for'])) {
			$this->type = trim(explode('(', $typeInfo['alias_for'])[0]);
			return $this->validate();
		}
		return match($this->type) {
			'TINYINT', 'SMALLINT', 'MEDIUMINT',
			'INT', 'BIGINT' 	=> $this->validateInteger($typeInfo),
			'DECIMAL' 				=> $this->validateDecimal($typeInfo),
			'FLOAT', 'DOUBLE' => $this->validateFloat($typeInfo),
			'VARCHAR', 'CHAR' => $this->validateVarchar($typeInfo),
			'ENUM' 						=> $this->validateEnum(),
			'SET' 						=> $this->validateSet(),
			default 					=> throw new ValException(
				"Validation not implemented for type: {type}",
				'validation_not_implemented',
				['type' => $this->type]
			)
		};
	}

	/**
	 * Validates integer types according to their range and specifications.
	 *
	 * @param array $typeInfo The metadata related to the data type.
	 * @throws ValException If the value is outside the valid range or is not numeric.
	 * @return bool True if valid.
	 */
	private function validateInteger(array $typeInfo): bool {
		if (!is_numeric($this->value)) {
			throw new ValException(
				"Value must be numeric, {type} given",
				'invalid_numeric',
				['type' => gettype($this->value)]
			);
		}

		$value = (int)$this->value;
		$min = $this->unsigned ? $typeInfo['min_unsigned'] : $typeInfo['min_signed'];
		$max = $this->unsigned ? $typeInfo['max_unsigned'] : $typeInfo['max_signed'];

		if ($value < $min || $value > $max) {
			throw new ValException(
				"Value must be between {min} and {max}, {value} given",
				'out_of_range',
				['min' => $min, 'max' => $max, 'value' => $value]
			);
		}

		if ($this->type === 'TINYINT' && $this->params && $this->params[0] === '1') {
			if (!in_array($value, [0, 1])) {
				throw new ValException(
					"Value must be 0 or 1 for TINYINT(1), {value} given",
					'invalid_boolean',
					['value' => $value]
				);
			}
		}

		return true;
	}

	/**
	 * Validates decimal types according to precision and scale.
	 *
	 * @param array $typeInfo The metadata related to the data type.
	 * @throws ValException If the value is not numeric or decimal parameters are invalid.
	 * @return bool True if valid.
	 */
	private function validateDecimal(array $typeInfo): bool {
		if (!is_numeric($this->value)) {
			throw new ValException(
				"Value must be numeric, {type} given",
				'invalid_numeric',
				['type' => gettype($this->value)]
			);
		}

		if (count($this->params) !== 2) {
			throw new ValException(
				"DECIMAL requires precision and scale parameters",
				'invalid_decimal_params',
				['params' => implode(',', $this->params)]
			);
		}

		list($precision, $scale) = array_map('intval', $this->params);

		if ($precision < 1 || $precision > 65) {
			throw new ValException(
				"Precision must be between 1 and 65, {precision} given",
				'invalid_precision',
				['precision' => $precision]
			);
		}

		if ($scale < 0 || $scale > 30 || $scale > $precision) {
			throw new ValException(
				"Scale must be between 0 and 30 and not greater than precision",
				'invalid_scale',
				['scale' => $scale, 'precision' => $precision]
			);
		}

		$value = (float)$this->value;
		$parts = explode('.', (string)abs($value));
		$integerPart = strlen($parts[0]);
		$decimalPart = isset($parts[1]) ? strlen($parts[1]) : 0;

		if ($integerPart > ($precision - $scale)) {
			throw new ValException(
				"Integer part exceeds maximum precision",
				'precision_overflow',
				['max_digits' => ($precision - $scale), 'actual_digits' => $integerPart]
			);
		}

		if ($decimalPart > $scale) {
			throw new ValException(
				"Decimal places exceed scale",
				'scale_overflow',
				['max_scale' => $scale, 'actual_scale' => $decimalPart]
			);
		}

		return true;
	}

	/**
	 * Validates varchar types based on their length.
	 *
	 * @param array $typeInfo The metadata related to the data type.
	 * @throws ValException If the value is not a string or exceeds max length.
	 * @return bool True if valid.
	 */
	private function validateVarchar(array $typeInfo): bool {
		if (!is_string($this->value)) {
			throw new ValException(
				"Value must be a string, {type} given",
				'invalid_string',
				['type' => gettype($this->value)]
			);
		}

		$maxLength = isset($this->params[0]) ? (int)$this->params[0] : $typeInfo['max_length'];

		if ($maxLength > $typeInfo['max_length']) {
			throw new ValException(
				"Maximum length cannot exceed {max}",
				'invalid_length_parameter',
				['max' => $typeInfo['max_length']]
			);
		}

		if (strlen($this->value) > $maxLength) {
			throw new ValException(
				"String length cannot exceed {max}, current length is {length}",
				'string_too_long',
				['max' => $maxLength, 'length' => strlen($this->value)]
			);
		}

		return true;
	}

	/**
	 * Validates enum types based on allowed values.
	 *
	 * @throws ValException If the ENUM parameters are empty or exceed limits.
	 * @return bool True if valid.
	 */
	private function validateEnum(): bool {
		if (empty($this->params)) {
			throw new ValException(
				"ENUM requires at least one value",
				'empty_enum_values'
			);
		}

		if (count($this->params) > 65535) {
			throw new ValException(
				"ENUM cannot have more than 65,535 values",
				'too_many_enum_values',
				['count' => count($this->params)]
			);
		}

		$allowedValues = array_map(function($value) {
			return trim($value, "'\"");
		}, $this->params);

		if (!in_array($this->value, $allowedValues)) {
			throw new ValException(
				"Value must be one of: {values}",
				'invalid_enum_value',
				['value' => $this->value, 'values' => implode(', ', $allowedValues)]
			);
		}

		return true;
	}

	/**
	 * Validates set types based on allowed values.
	 *
	 * @throws ValException If the SET parameters are empty or exceed limits.
	 * @return bool True if valid.
	 */
	private function validateSet(): bool {
		if (empty($this->params)) {
			throw new ValException(
				"SET requires at least one value",
				'empty_set_values'
			);
		}

		if (count($this->params) > 64) {
			throw new ValException(
				"SET cannot have more than 64 values",
				'too_many_set_values',
				['count' => count($this->params)]
			);
		}

		$allowedValues = array_map(function($value) {
			return trim($value, "'\"");
		}, $this->params);

		$inputValues = array_map('trim', explode(',', $this->value));

		foreach ($inputValues as $value) {
			if (!in_array($value, $allowedValues)) {
				throw new ValException(
					"Invalid value '{value}'. Must be one of: {values}",
					'invalid_set_value',
					['value' => $value, 'values' => implode(', ', $allowedValues)]
				);
			}
		}

		return true;
	}
}