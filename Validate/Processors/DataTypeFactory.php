<?php

namespace Yohns\Validate\Processors;

use Yohns\Validate\Processors\{
																DataTypeProcessorInterface,
																DataTypeException,
																BlobHandler,
																BoolHandler,
																CollectionHandler,
																DateHandler,
																DatetimeHandler,
																DecimalHandler,
																GeometryHandler,
																IntHandler,
																JsonHandler,
																StringHandler,
																YearHandler
															};

final class DataTypeFactory {

	public static function create(string $hanlder, mixed $input, array $dataTypeSchema, array $rules): array|DataTypeException {
		$className = 'Yohns\\Validate\\Processors\\'.$hanlder.'Handler';

		if (class_exists($className)) {
			$ret = new $className();
			return $ret->process($input, $dataTypeSchema, $rules);
		} else {
			throw new DataTypeException('DataTypeFactory '.$hanlder.'Handler not found');
		}
		//return new StringHandler();
		//return new BlobHandler();
		//return new BoolHandler();
		//return new CollectionHandler();
		//return new DateHandler();
		//return new DatetimeHandler();
		//return new DecimalHandler();
		//return new GeometryHandler();
		//return new IntHandler();
		//return new StringHandler();
		//return new YearHandler();
	}
}