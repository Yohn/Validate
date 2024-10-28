<?php

namespace Yohns\Validate\Traits;

use Yohns\Validate\Exception\ValidationException;

/**
 * Trait GeometryTrait
 *
 * This trait provides functionalities to validate geometric data formats
 * using Well-Known Text (WKT) standards. It includes a method to validate
 * various types of geometric representations.
 */
trait GeometryTrait
{
	/**
	 * Validates a geometric string against a specified geometry type.
	 *
	 * This method checks if the provided geometry type is valid and
	 * matches the corresponding WKT format. Valid geometry types include
	 * POINT, LINESTRING, POLYGON, MULTIPOINT, MULTILINESTRING,
	 * MULTIPOLYGON, GEOMETRY, and GEOMETRYCOLLECTION.
	 *
	 * @param string $type The type of geometry to validate.
	 * Valid options are 'GEOMETRY', 'GEOMETRYCOLLECTION',
	 * 'MULTILINESTRING', 'MULTIPOINT', 'MULTIPOLYGON',
	 * 'POINT', 'LINESTRING', 'POLYGON'.
	 *
	 * @param string $string The geometric string to validate against
	 * the specified type.
	 *
	 * @return bool Returns true if the geometry type is valid and
	 * the string matches the corresponding WKT format; otherwise,
	 * it returns false.
	 */
	public static function validateGeometry(string $type, string $string, array $rules): bool {
	// List of known geometry types
	$validTypes = [
		'GEOMETRY',
		'GEOMETRYCOLLECTION',
		'MULTILINESTRING',
		'MULTIPOINT',
		'MULTIPOLYGON',
		'POINT',
		'LINESTRING',
		'POLYGON'
	];

	// Check if the given type is valid
	if (!in_array(strtoupper($type), $validTypes)) {
		return false;
	}

	// Regular expressions for basic validation of WKT (Well-Known Text) formats
	$wktPatterns = [
		'POINT' => '/^POINT\s*\(\s*\d+(\.\d+)?\s+\d+(\.\d+)?\s*\)$/i',
		'LINESTRING' => '/^LINESTRING\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\)$/i',
		'POLYGON' => '/^POLYGON\s*\(\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\s*\)\s*\)$/i',
		'MULTIPOINT' => '/^MULTIPOINT\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\)$/i',
		'MULTILINESTRING' => '/^MULTILINESTRING\s*\(\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\)\s*\)$/i',
		'MULTIPOLYGON' => '/^MULTIPOLYGON\s*\(\s*\(\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\s*\)\s*\)\s*\)$/i',
		// Assuming GEOMETRY and GEOMETRYCOLLECTION as complex and multi-form, not using strict regex
		'GEOMETRY' => '/^\w+\s*\(.*\)$/i',
		'GEOMETRYCOLLECTION' => '/^GEOMETRYCOLLECTION\s*\(.*\)$/i'
	];

	// Fetch the relevant regex pattern for the type
	$pattern = $wktPatterns[strtoupper($type)] ?? null;

	// Validate the string against the regex pattern
	if ($pattern && preg_match($pattern, $string)) {
		return true;
	}

	return false;
}
}