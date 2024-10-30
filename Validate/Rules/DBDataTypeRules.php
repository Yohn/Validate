<?php
/* --------------------------------
Database Column Data Types Accepted:

JSON
TINYINT
SMALLINT
MEDIUMINT
INT
BIGINT
DECIMAL
NUMERIC
FLOAT
DOUBLE
BIT
BOOL
ENUM
SET
DATE
DATETIME
TIMESTAMP
TIME
YEAR
CHAR
VARCHAR
TINYTEXT
TEXT
MEDIUMTEXT
LONGTEXT
BINARY
VARBINARY
TINYBLOB
BLOB
MEDIUMBLOB
LONGBLOB
GEOMETRY
POINT
LINESTRING
POLYGON
MULTIPOINT
MULTILINESTRING
MULTIPOLYGON
GEOMETRYCOLLECTION

*/
/**
 * Defines patterns and constraints for various SQL data types.
 *
 * This array holds the defining characteristics of different data types,
 * including regex patterns for validation, min/max values, and other metadata.
 * The supported data types are: TINYINT, SMALLINT, MEDIUMINT, INT, BIGINT,
 * DECIMAL, NUMERIC, FLOAT, DOUBLE, BIT, BOOL, ENUM, SET, DATE, DATETIME,
 * TIMESTAMP, TIME, YEAR, CHAR, VARCHAR, TEXT, BLOB, GEOMETRY types, and JSON.
 *
 * @return array<string, array<string, mixed>>
 */
return [
	'JSON'		=> [
		'pattern' => '/^.*$/',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['json'],
	], // JSON validation can be done with json_decode
	'TINYINT' => [
		'pattern'     => '/^-?\d{1,3}$/',
		'min_signed'  => -128,
		'max_signed'  => 127,
		'min_unsigned' => 0,
		'max_unsigned' => 255,
		'PARAM_TYPE' => PDO::PARAM_INT,
		'rule' => ['int'],
	],
	'SMALLINT' => [
		'pattern'     => '/^-?\d{1,5}$/',
		'min_signed'  => -32768,
		'max_signed'  => 32767,
		'min_unsigned' => 0,
		'max_unsigned' => 65535,
		'PARAM_TYPE' => PDO::PARAM_INT,
		'rule' => ['int'],
	],
	'MEDIUMINT' => [
		'pattern'     => '/^-?\d{1,7}$/',
		'min_signed'  => -8388608,
		'max_signed'  => 8388607,
		'min_unsigned' => 0,
		'max_unsigned' => 16777215,
		'PARAM_TYPE' => PDO::PARAM_INT,
		'rule' => ['int'],
	],
	'INT' => [
		'pattern'     => '/^-?\d{1,10}$/',
		'min_signed'  => -2147483648,
		'max_signed'  => 2147483647,
		'min_unsigned' => 0,
		'max_unsigned' => 4294967295,
		'PARAM_TYPE' => PDO::PARAM_INT,
		'rule' => ['int'],
	],
	'BIGINT' => [
		'pattern'     => '/^-?\d{1,19}$/',
		'min_signed'  => -9223372036854775808,
		'max_signed'  => 9223372036854775807,
		'min_unsigned' => 0,
		'max_unsigned' => 18446744073709551615,
		'PARAM_TYPE' => PDO::PARAM_INT,
		'rule' => ['int'],
	],
	'DECIMAL' => [
		'pattern'     => '/^-?\d+(\.\d+)?$/',
		//'min_signed'  => 'depends on precision',
		//'max_signed'  => 'depends on precision',
		//'min_unsigned' => 0,
		//'max_unsigned' => 'depends on precision',
		'has_decimal_places' => true,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['float'],
	],
	'NUMERIC' => [
		'pattern'     => '/^-?\d+(\.\d+)?$/',
		//'min_signed'  => 'depends on precision',
		//'max_signed'  => 'depends on precision',
		//'min_unsigned' => 0,
		//'max_unsigned' => 'depends on precision',
		'has_decimal_places' => true,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['float'],
	],
	'FLOAT' => [
		'pattern'     => '/^-?\d+(\.\d+)?([eE][-+]?\d+)?$/',
		'min_signed'  => -3.402823466E+38,
		'max_signed'  => 3.402823466E+38,
		'min_unsigned' => 0,
		'max_unsigned' => 3.402823466E+38,
		'has_decimal_places' => true,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['float'],
	],
	'DOUBLE' => [
		'pattern'     => '/^-?\d+(\.\d+)?([eE][-+]?\d+)?$/',
		'min_signed'  => -1.7976931348623157E+308,
		'max_signed'  => 1.7976931348623157E+308,
		'min_unsigned' => 0,
		'max_unsigned' => 1.7976931348623157E+308,
		'has_decimal_places' => true,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['float'],
	],
	'BIT' => [
		'pattern'     => '/^[01]$/',
		'signed'      => ['min' => 0, 'max' => 1],
		'unsigned'    => ['min' => 0, 'max' => 1],
		'PARAM_TYPE' => PDO::PARAM_INT,
		'rule' => ['bool'],
	],
	'BOOL' => [
		'pattern'     => '/^(0|1|true|false|null)$/i',
		'signed'      => ['min' => 0, 'max' => 1],
		'unsigned'    => ['min' => 0, 'max' => 1],
		'PARAM_TYPE' => PDO::PARAM_INT,
		'rule' => ['bool'],
	],
	'ENUM' => [ // Specific values should be checked separately
		'pattern' 			=> '/^.*$/',
		'max_elements' 	=> 65535, // The maximum number of values you can define
		'max_in' 	=> 1,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['set'],
	],
	'SET' => [ // Specific values should be checked separately
		'pattern' 			=> '/^.*$/',
		'max_elements' 	=> 64, // Up to 64 elements
		'max_in' 	=> 64,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['set'],
	],
	'DATE' => [
		'pattern' => '/^\d{4}-\d{2}-\d{2}$/',
		'format'  => 'YYYY-MM-DD',
		'range'   => ['1000-01-01', '9999-12-31'],
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['date'],
	],
	'DATETIME' => [
		'pattern' => '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/',
		'format'  => 'YYYY-MM-DD HH:MM:SS',
		'range'   => ['1000-01-01 00:00:00', '9999-12-31 23:59:59'],
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['datetime'],
	],
	'TIMESTAMP' => [
		'pattern' => '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/',
		'format'  => 'YYYY-MM-DD HH:MM:SS',
		'range'   => ['1970-01-01 00:00:01', '2038-01-19 03:14:07'],
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['beforedatetime(2038-01-18 23:59:00)'],
	],
	'TIME' => [
		'pattern' => '/^\d{2}:\d{2}:\d{2}$/',
		'range'   => ['-838:59:59', '838:59:59'],
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['time'],
	],
	'YEAR' => [
		'pattern'   => '/^\d{4}$/',
		'min_value' => 1901,
		'max_value' => 2155,
		'format'    => 'YYYY',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['year', 'max(2155)'],
	],
	'CHAR' => [
		'pattern' 		=> '/^.{1}$/',
		'max_length' 	=> 255,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['text', 'maxlength(255)'],
	],
	'VARCHAR' => [
		'pattern' 		=> '/^.{1,255}$/',
		'max_length' 	=> 65535,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['text', 'maxlength(65535)'],
	],
	'TINYTEXT' => [
		'pattern' 		=> '/^.{1,255}$/',
		'max_length' 	=> 255,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['text', 'maxlength(255)'],
	],
	'TEXT' => [
		'pattern' 		=> '/^.{1,65535}$/',
		'max_length' 	=> 65535,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['text', 'maxlength(65535)'],
	],
	'MEDIUMTEXT' => [
		'pattern' 		=> '/^.{1,16777215}$/',
		'max_length' 	=> 16777215,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['text', 'maxlength(16777215)'],
	],
	'LONGTEXT' => [
		'pattern' 		=> '/^.{1,4294967295}$/',
		'max_length' 	=> 4294967295,
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['text', 'maxlength(4294967295)'],
	],
	'BINARY' => [
		'pattern' 		=> '/^[\x00-\xFF]{1}$/',
		'max_length' 	=> 255,
		'PARAM_TYPE' => PDO::PARAM_LOB,
		'rule' => ['text', 'maxsize(255)'],
	],
	'VARBINARY' => [
		'pattern' 		=> '/^[\x00-\xFF]{1,255}$/',
		'max_length' 	=> 65535,
		'PARAM_TYPE' => PDO::PARAM_LOB,
		'rule' => ['text', 'maxsize(255)'],
	],
	'TINYBLOB' => [
		'pattern' 		=> '/^[\x00-\xFF]{1,255}$/',
		'max_length' 	=> 255,
		'PARAM_TYPE' => PDO::PARAM_LOB,
		'rule' => ['text', 'maxsize(255)'],
	],
	'BLOB' => [
		'pattern' 		=> '/^[\x00-\xFF]{1,65535}$/',
		'max_length' 	=> 65535,
		'PARAM_TYPE' => PDO::PARAM_LOB,
		'rule' => ['text', 'maxsize(65535)'],
	],
	'MEDIUMBLOB' => [
		'pattern' 		=> '/^[\x00-\xFF]{1,16777215}$/',
		'max_length' 	=> 16777215,
		'PARAM_TYPE' => PDO::PARAM_LOB,
		'rule' => ['text', 'maxsize(16777215)'],
	],
	'LONGBLOB' => [
		'pattern' 		=> '/^[\x00-\xFF]{1,4294967295}$/',
		'max_length' 	=> 4294967295,
		'PARAM_TYPE' 	=> PDO::PARAM_LOB,
		'rule' => ['text', 'maxsize(4294967295)'],
	],
	'GEOMETRY' 				=> [
		'pattern' => '/^\w+\s*\(.*\)$/i',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['geo'],
	], // Complex validation required
	'POINT' 					=> [
		'pattern' => '/^POINT\s*\(\s*\d+(\.\d+)?\s+\d+(\.\d+)?\s*\)$/i',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['geo'],
	], // Complex validation required
	'LINESTRING' 			=> [
		'pattern' => '/^LINESTRING\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\)$/i',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['geo'],
	], // Complex validation required
	'POLYGON' 				=> [
		'pattern' => '/^POLYGON\s*\(\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\s*\)\s*\)$/i',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['geo'],
	], // Complex validation required
	'MULTIPOINT' 			=> [
		'pattern' => '/^MULTIPOINT\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\)$/i',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['geo'],
	], // Complex validation required
	'MULTILINESTRING' => [
		'pattern' => '/^MULTILINESTRING\s*\(\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\)\s*\)$/i',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['geo'],
	], // Complex validation required
	'MULTIPOLYGON' 		=> [
		'pattern' => '/^MULTIPOLYGON\s*\(\s*\(\s*\(\s*((\d+(\.\d+)?\s+\d+(\.\d+)?)(,\s*)?)+\s*\)\s*\)\s*\)$/i',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['geo'],
	], // Complex validation required
	'GEOMETRYCOLLECTION' => [
		'pattern' => '/^GEOMETRYCOLLECTION\s*\(.*\)$/i',
		'PARAM_TYPE' => PDO::PARAM_STR,
		'rule' => ['geo'],
	], // Complex validation required
];