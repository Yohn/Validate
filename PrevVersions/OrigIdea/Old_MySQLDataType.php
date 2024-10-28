<?php
return [
	//Numeric
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


	'REAL' => [
		'description' => 'Synonym for DOUBLE (exception: in REAL_AS_FLOAT SQL mode it is a synonym for FLOAT)',
	],

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


	//Date and time
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

	//String
	'CHAR' => ['max_length' => 255],
	'VARCHAR' => ['max_length' => 65535],
	'TINYTEXT' => ['max_length' => 255],
	'TEXT' => ['max_length' => 65535],
	'MEDIUMTEXT' => ['max_length' => 16777215],
	'LONGTEXT' => ['max_length' => 4294967295],


	'BINARY' => [
		'max_length' => 255
	],
	'VARBINARY' => [
		'max_length' => 65535
	],

	'TINYBLOB' 		=> ['max_length' => 255],
	'BLOB' 				=> ['max_length' => 65535],
	'MEDIUMBLOB' 	=> ['max_length' => 16777215],
	'LONGBLOB' 		=> ['max_length' => 4294967295],


	// String Data Types (continued)
	'ENUM' => [
		'description' 	=> 'A string object with a value chosen from a list of permitted values.',
		'max_elements' 	=> 65535, // The maximum number of values you can define
		'values_type' 	=> 'string',
		'elements'			=> 1 // can only store 1
	],
	'SET' => [
		'description' 	=> 'A string object that can have zero or more values, each chosen from a list of permitted values.',
		'max_elements' 	=> 64, // Up to 64 elements
		'values_type' 	=> 'string',
		'elements'			=> [0,64], // can store 0 or multiple values
	],

	//Spatial
	'GEOMETRY' => [
		'description' => 'A spatial data type that can store geometry values of any type (POINT, LINESTRING, POLYGON).',
		'pattern' => '/^\w+\s*\(.*\)$/i',
	],
	'GEOMETRYCOLLECTION' => [
		'description' => 'A collection of zero or more geometry values (POINT, LINESTRING, POLYGON).',
		'pattern' => '/^GEOMETRYCOLLECTION\s*\(.*\)$/i',
	],
	'MULTILINESTRING' => [
		'description' => 'A collection of one or more LINESTRING geometries.',
		'pattern' => '/^MULTILINESTRING\s*\(\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\)\s*\)$/i',
	],
	'MULTIPOINT' => [
		'description' => 'A collection of one or more POINT geometries.',
		'pattern' => '/^MULTIPOINT\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\)$/i',
	],
	'MULTIPOLYGON' => [
		'description' => 'A collection of one or more POLYGON geometries.',
		'pattern' => '/^MULTIPOLYGON\s*\(\s*\(\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\s*\)\s*\)\s*\)$/i',
	],
	'POINT' => [
		'description' => 'A point in 2D space (x, y)',
		'pattern' => '/^POINT\s*\(\s*\d+(\.\d+)?\s+\d+(\.\d+)?\s*\)$/i',
	],
	'LINESTRING' => [
		'description' => 'A geometry type that stores a line consisting of points in 2D space.',
		'pattern' => '/^LINESTRING\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\)$/i',
	],
	'POLYGON' => [
		'description' => 'A geometry type that stores a polygon, which is defined by one or more linear rings (closed LineStrings).',
		'pattern' => '/^POLYGON\s*\(\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\s*\)\s*\)$/i',
	],


	'JSON' => [
		'description' => 'Stores JSON (JavaScript Object Notation) data in a text-based format.',
		'format' => 'JSON format'
	],
];