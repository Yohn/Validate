<?php

namespace Yohns\Validate;

use PDO;
use Yohns\Core\Config;
use Yohns\Lang\Text;
use Yohns\Validate\Processors\DataTypeException;
use Yohns\Validate\Processors\DataTypeFactory;

final class MySQLDataTypes
{
	private static array $rules;
	private static array $unsignedDataTypes;
	private static bool $signed = true;
	private static array $decimalTypes;
	private static string|null $BlobMimeTypes = null;
	private static string $BlobMimeTypesFileName = 'DBBlobMimeTypes';
	private static array $multiCommaTypes;

	public function __construct(){
		self::getRules();
	}

	private static function getRules(): void {
		// setting flags for specific data types to check for
		// these are just possible to have unsigned values (negative numbers)
		self::$unsignedDataTypes = [
			'TINYINT','SMALLINT',	'MEDIUMINT','INT',
			'BIGINT',	'FLOAT',		'DOUBLE',		'DECIMAL'
		];

		self::$decimalTypes = ['NUMERIC','DECIMAL','FLOAT'];
		self::$multiCommaTypes = ['SET','ENUM'];
		$getRules = Config::getAll('DBDataTypeRules');
		if($getRules === null){
			throw new DataTypeException('Ensure the Config object was initiated before using this class.');
		}

		self::$rules = $getRules;
		if (count(self::$rules) === 0) {
			# get local configs
			self::$rules = include __DIR__ . '/Rules/DBDataTypeRules.php';
		}
	}

	/**
	 * The runCheck function below might have been to check input,
	 * but I moved that to the RuleFactory in the Input/Rules namespace
	 *
	 * We do need this class to build the rules that the Input/Rules
	 * namespace have created.
	 *
	 * @param array $rules this will be the string with the rules based on db column
	 */
	public static function buildRule(array $column): string{
		if (count(self::$rules) === 0) {
			self::getRules();
		}
		$col = self::$rules[strtoupper($column['DATA_TYPE'])];
		if($column['DATA_TYPE'] === 'ENUM'){
			//$avail =  explode(',', strtr($column['COLUMN_TYPE'], ['enum(' => '', ')' => '', "'" => '']));
			$avail =  strtr($column['COLUMN_TYPE'], ['enum(' => '', ')' => '', "'" => '']);
			return [
				'rules' => 'inlist('.$avail.')',
				'param' => PDO::PARAM_STR,
			];
		} else if($column['COLUMN_TYPE'] == 'tinyint(1)' || in_array($column['DATA_TYPE'], ['bit', 'bool'])){ //
			$rules[] = 'bool';
			$rules[] = 'min(0)';
			$rules[] = 'max(1)';
		} else {
			if(in_array($column['DATA_TYPE'], ['TINYINT', 'SMALLINT', 'MEDIUMINT', 'INT', 'BIGINT'])){
				if(str_ends_with($column['COLUMN_TYPE'], 'unsigned')){
					$is_unsigned = true;
					$rules[] = 'between('.$col['min_signed'].','.$col['max_signed'].')';
					//$rules[] = 'min()';
					//$rules[] = 'max()';
				} else {
					$is_unsigned = false;
					$rules[] = 'between('.$col['min_signed'].','.$col['max_signed'].')';
					$rules[] = 'int';
					//$rules[] = 'min()';
					//$rules[] = 'max()';
				}
			}
			$imgTypes = Config::get('allowsImgMimes');
			if($imgTypes == false){
				$imgTypes = include __DIR__.'/Rules/DBImageTypes.php';
			}
			if($column['IS_NULLABLE'] == 'yes'){
				$rules[] = 'nullable';
			} else {
				$rules[] = 'required';
			}

			if(str_contains($column['COLUMN_NAME'], 'email')){
				$rules[] = 'email';
			} else if(str_contains($column['COLUMN_NAME'], 'pic')){
				$rules[] = 'file('.implode(',',$imgTypes).')';
			} else if(str_contains($column['COLUMN_NAME'], 'username')){
				$rules[] = 'alphadash';
				$rules[] = 'startswith(alphanumeric)';
				$rules[] = 'endswith(alphanumeric)';
			} else if(str_contains($column['COLUMN_NAME'], 'url')){
				$rules[] = 'url';
			}
			if($columns['CHARACTER_MAXIMUM_LENGTH'] !== NULL){
				$rules[] = 'maxlength('.$columns['CHARACTER_MAXIMUM_LENGTH'].')';
			}
		}
		return [
			'rules' => implode('|', $rules),
			'param' => $col['PARAM_TYPE'],
		];
	}

	/**
	 * runCheck filters out what needs to be done based on the column type
	 *
	 * @param mixed $input The value that will be added to the database
	 *  Can be of type int or string
	 * @param string $column the info schema of the column
	 *  //!DATA_TYPE is returning the actual type without other () or text after it
	 *  'DATA_TYPE' => 'bigint',
	 *  //! this is how we find if its unsigned, or has values within it
	 *  'COLUMN_TYPE' => 'bigint unsigned',
	 *  'COLUMN_TYPE' => 'decimal(10,2)',
	 *  'COLUMN_TYPE' => 'enum(\'value1\',\'value2\',\'value3\')',
	 *
	 */
	public static function runCheck(int|string $input, array $column): array|bool {
		$dataTypeName = strtoupper($column['DATA_TYPE']);
		$dataTypeRule = self::$rules[$dataTypeName] ?? false;
		if($dataTypeRule === false){
			// column isnt found in db schema file
			//~ - schema file is all the different db column types..
			return ['status' => 'error', 'msg' => Text::L('Database type [data-type] not found', ['[data-type]' => $column['DATA_TYPE']])];
		}

		if (!preg_match($dataTypeRule['pattern'], $input)) {
			return ['status' => 'error', 'msg' => Text::L('Incorrect format for database column [column]', ['[column]' => $column['DATA_TYPE']])];
		}

		// passed the pattern test..
		if(in_array($column['DATA_TYPE'], self::$unsignedDataTypes)
			&& str_ends_with($column['COLUMN_TYPE'], 'unsigned')
		) {
				// is unsigned..
				self::$signed = false;
		}

		return match ($dataTypeName) {
			'TINYINT', 'SMALLINT',
			'MEDIUMINT', 'INT', 'BIGINT' 	=> DataTypeFactory::create('Int', 				$input, $column, $dataTypeRule),
			'DECIMAL', 'NUMERIC',
			'FLOAT', 'DOUBLE' 						=> DataTypeFactory::create('Decimal', 		$input, $column, $dataTypeRule),
			'DATE' 												=> DataTypeFactory::create('Date', 				$input, $column, $dataTypeRule),
			'DATETIME', 'TIMESTAMP'  			=> DataTypeFactory::create('DateTime', 		$input, $column, $dataTypeRule),
			'TIME' 												=> DataTypeFactory::create('Time', 				$input, $column, $dataTypeRule),
			'YEAR' 												=> DataTypeFactory::create('Year', 				$input, $column, $dataTypeRule),
			'JSON' 												=> DataTypeFactory::create('Json', 				$input, $column, $dataTypeRule),
			'ENUM','SET' 									=> DataTypeFactory::create('Collection', 	$input, $column, $dataTypeRule),
			'BIT','BOOL' 									=> DataTypeFactory::create('Bool', 				$input, $column, $dataTypeRule),
			'BINARY','VARBINARY','TINYBLOB',
			'BLOB','MEDIUMBLOB','LONGBLOB' => DataTypeFactory::create('Blob', 			$input, $column, $dataTypeRule),
			'GEOMETRY','POINT','LINESTRING',
			'POLYGON','MULTIPOINT','MULTILINESTRING',
			'MULTIPOLYGON','GEOMETRYCOLLECTION' => DataTypeFactory::create('Geometry', $input, $column, $dataTypeRule),
			default => DataTypeFactory::create('String', $input, $column, $dataTypeRule),
		};
	}
}