<?php

use Yohns\Validate\MySQLDataTypes;
use Yohns\Validate\Processors\DataTypeException;
use Yohns\Validate\Processors\DataTypeFactory;
use Yohns\Validate\Processors\DataTypeInterface;
use Yohns\Core\Config;

include 'vendor/autoload.php';

new Config(__DIR__.'/lib/Config');

$validate = new MySQLDataTypes();

// inserting a number into column
$uhm = $validate->runCheck(24, [
	'TABLE_CATALOG' => 'def',
	'TABLE_SCHEMA' => '2025_db_tester',
	'TABLE_NAME' => 'datatypes_tweaked',
	'COLUMN_NAME' => 'INT_COL',
	'ORDINAL_POSITION' => '5',
	'COLUMN_DEFAULT' => '0',
	'IS_NULLABLE' => 'NO',
	'DATA_TYPE' => 'int',
	'CHARACTER_MAXIMUM_LENGTH' => NULL,
	'CHARACTER_OCTET_LENGTH' => NULL,
	'NUMERIC_PRECISION' => '10',
	'NUMERIC_SCALE' => '0',
	'DATETIME_PRECISION' => NULL,
	'CHARACTER_SET_NAME' => NULL,
	'COLLATION_NAME' => NULL,
	'COLUMN_TYPE' => 'int',
	'COLUMN_KEY' => '',
	'EXTRA' => '',
	'PRIVILEGES' => 'select,insert,update,references',
	'COLUMN_COMMENT' => '',
	'GENERATION_EXPRESSION' => '',
	'SRS_ID' => NULL
]);

print_r($uhm);