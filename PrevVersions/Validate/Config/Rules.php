<?php
//$mysql_column_types = [
return [
	// Numeric Data Types
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
	'DECIMAL' => [
		'min_signed' => 'depends on precision',
		'max_signed' => 'depends on precision',
		'min_unsigned' => 0,
		'max_unsigned' => 'depends on precision',
		'has_decimal_places' => true
	],
	'FLOAT' => [
		'min_signed' => -3.402823466E+38,
		'max_signed' => 3.402823466E+38,
		'min_unsigned' => 0,
		'max_unsigned' => 3.402823466E+38,
		'has_decimal_places' => true
	],
	'DOUBLE' => [
		'min_signed' => -1.7976931348623157E+308,
		'max_signed' => 1.7976931348623157E+308,
		'min_unsigned' => 0,
		'max_unsigned' => 1.7976931348623157E+308,
		'has_decimal_places' => true
	],

	// String Data Types
	'CHAR' => [
		'max_length' => 255
	],
	'VARCHAR' => [
		'max_length' => 65535
	],
	'TINYTEXT' => [
		'max_length' => 255
	],
	'TEXT' => [
		'max_length' => 65535
	],
	'MEDIUMTEXT' => [
		'max_length' => 16777215
	],
	'LONGTEXT' => [
		'max_length' => 4294967295
	],

	// Binary Data Types
	'BINARY' => [
		'max_length' => 255
	],
	'VARBINARY' => [
		'max_length' => 65535
	],
	'TINYBLOB' => [
		'max_length' => 255
	],
	'BLOB' => [
		'max_length' => 65535
	],
	'MEDIUMBLOB' => [
		'max_length' => 16777215
	],
	'LONGBLOB' => [
		'max_length' => 4294967295
	],

	// Date and Time Data Types
	'DATE' => [
		'format' => 'YYYY-MM-DD',
		'range' => ['1000-01-01', '9999-12-31']
	],
	'DATETIME' => [
		'format' => 'YYYY-MM-DD HH:MM:SS',
		'range' => ['1000-01-01 00:00:00', '9999-12-31 23:59:59']
	],
	'TIMESTAMP' => [
		'format' => 'YYYY-MM-DD HH:MM:SS',
		'range' => ['1970-01-01 00:00:01', '2038-01-19 03:14:07']
	],
	'TIME' => [
		'format' => 'HH:MM:SS',
		'range' => ['-838:59:59', '838:59:59']
	],
	'YEAR' => [
		'min_value' => 1901,
		'max_value' => 2155
	],

	// Boolean Data Type
	'BOOLEAN' => [
		'possible_values' => [0, 1]
	],

	// Spatial Data Types (simplified)
	'POINT' => [
		'description' => 'A point in 2D space (x, y)'
	],
	'LINESTRING' => [
		'description' => 'A line of points in 2D space'
	],
	'POLYGON' => [
		'description' => 'A polygon defined by a series of points'
	],
	// Numeric Data Types (continued)
	'BIT' => [
		'description' => 'A bit field type, can store 1 to 64 bits.',
		'max_length' => 64
	],
	'BOOL' => [
		'alias_for' => 'BOOLEAN',
		'possible_values' => [0, 1]
	],
	'BOOLEAN' => [
		'alias_for' => 'TINYINT(1)',
		'possible_values' => [0, 1]
	],
	'SERIAL' => [
		'alias_for' => 'BIGINT UNSIGNED AUTO_INCREMENT',
		'description' => 'Alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE.'
	],

	// Fixed-Point Data Types
	'NUMERIC' => [
		'alias_for' => 'DECIMAL',
		'min_signed' => 'depends on precision',
		'max_signed' => 'depends on precision',
		'min_unsigned' => 0,
		'max_unsigned' => 'depends on precision',
		'has_decimal_places' => true
	],

	// String Data Types (continued)
	'ENUM' => [
		'description' => 'A string object with a value chosen from a list of permitted values.',
		'max_elements' => 65535, // The maximum number of values you can define
		'values_type' => 'string'
	],
	'SET' => [
		'description' => 'A string object that can have zero or more values, each chosen from a list of permitted values.',
		'max_elements' => 64, // Up to 64 elements
		'values_type' => 'string'
	],

	// Binary Data Types (continued)
	'GEOMETRY' => [
		'description' => 'A spatial data type that can store geometry values of any type (POINT, LINESTRING, POLYGON).'
	],
	'GEOMETRYCOLLECTION' => [
		'description' => 'A collection of zero or more geometry values (POINT, LINESTRING, POLYGON).'
	],
	'MULTILINESTRING' => [
		'description' => 'A collection of one or more LINESTRING geometries.'
	],
	'MULTIPOINT' => [
		'description' => 'A collection of one or more POINT geometries.'
	],
	'MULTIPOLYGON' => [
		'description' => 'A collection of one or more POLYGON geometries.'
	],

	// JSON Data Types
	'JSON' => [
		'description' => 'Stores JSON (JavaScript Object Notation) data in a text-based format.',
		'format' => 'JSON format'
	],

	// Date and Time Data Types (continued)
	'TIMESTAMP WITH TIME ZONE' => [
		'description' => 'A timestamp with time zone support (non-standard, some MySQL forks support this).',
		'range' => ['1970-01-01 00:00:01 UTC', '2038-01-19 03:14:07 UTC']
	],

	// Aliases or Synonyms for Date and Time Types
	'DATETIME(0-6)' => [
		'description' => 'Stores date and time with fractional seconds precision, specified by the number of digits (0 to 6).',
		'range' => ['1000-01-01 00:00:00', '9999-12-31 23:59:59']
	],
	'TIMESTAMP(0-6)' => [
		'description' => 'Stores timestamp with fractional seconds precision, specified by the number of digits (0 to 6).',
		'range' => ['1970-01-01 00:00:01', '2038-01-19 03:14:07']
	],

	// Aliases for Numeric Types
	'DEC' => [
		'alias_for' => 'DECIMAL',
		'min_signed' => 'depends on precision',
		'max_signed' => 'depends on precision',
		'min_unsigned' => 0,
		'max_unsigned' => 'depends on precision',
		'has_decimal_places' => true
	],

	// Spatial Data Types (continued)
	'LINESTRING' => [
		'description' => 'A geometry type that stores a line consisting of points in 2D space.'
	],
	'POLYGON' => [
		'description' => 'A geometry type that stores a polygon, which is defined by one or more linear rings (closed LineStrings).'
	],

	// Other Aliases or Synonyms for Data Types
	'FIXED' => [
		'alias_for' => 'DECIMAL',
		'min_signed' => 'depends on precision',
		'max_signed' => 'depends on precision',
		'min_unsigned' => 0,
		'max_unsigned' => 'depends on precision',
		'has_decimal_places' => true
	],
	// Deprecated or Uncommon Data Types
	'YEAR(2)' => [
		'description' => 'Stores a year in two-digit format (deprecated, use YEAR(4)).',
		'range' => ['1970', '2069'] // Only covers this range due to the two-digit limitation
	]
];