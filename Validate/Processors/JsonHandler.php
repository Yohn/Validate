<?php

namespace Yohns\Validate\Processors;

use Yohns\Validate\Processors\DataTypeInterface;

class JsonHandler implements  DataTypeInterface {

	public function process(mixed $input, array $dataTypeSchema, array $rules): mixed {
		// use json_validate()
	}
}