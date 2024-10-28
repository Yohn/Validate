<?php

final class Numbers
{
	function validateValue($type, $value, $isUnsigned = false) {
	$limits = [
		'TINYINT' => [
			'min_signed' => -128,
			'max_signed' => 127,
			'min_unsigned' => 0,
			'max_unsigned' => 255
		],
		'SMALLINT' => [
			'min_signed' => -32768,
			'max_signed' => 32767,
			'min_unsigned' => 0,
			'max_unsigned' => 65535
		],
		'MEDIUMINT' => [
			'min_signed' => -8388608,
			'max_signed' => 8388607,
			'min_unsigned' => 0,
			'max_unsigned' => 16777215
		],
		'INT' => [
			'min_signed' => -2147483648,
			'max_signed' => 2147483647,
			'min_unsigned' => 0,
			'max_unsigned' => 4294967295
		],
		'BIGINT' => [
			'min_signed' => -9223372036854775808,
			'max_signed' => 9223372036854775807,
			'min_unsigned' => 0,
			'max_unsigned' => 18446744073709551615
		],
	];

	if (!isset($limits[$type])) {
		throw new InvalidArgumentException("Invalid type specified.");
	}

	$limit = $limits[$type];

	if ($isUnsigned) {
		return ($value >= $limit['min_unsigned'] && $value <= $limit['max_unsigned']);
	} else {
		return ($value >= $limit['min_signed'] && $value <= $limit['max_signed']);
	}
	}
}

// Example usage:
$type = 'TINYINT';
$value = 130; // Change this value for testing
$isUnsigned = false; // Change this to true for unsigned validation

if (validateValue($type, $value, $isUnsigned)) {
	echo "$value is a valid $type value.\n";
} else {
	echo "$value is NOT a valid $type value.\n";
}
