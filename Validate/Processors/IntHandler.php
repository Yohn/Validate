<?php

namespace Yohns\Validate\Processors;

use Yohns\Validate\Processors\DataTypeInterface;

class IntHandler implements  DataTypeInterface {

	public function process(mixed $input, array $dataTypeSchema, array $rules): mixed {
		return [
			'status' => 'ok',
			'pdoParam' => $rules['PARAM_TYPE'],
			'check' => [
				'input' => $input,
				'dataTypeSchema' => $dataTypeSchema,
				'rules' => $rules
			]
		];
	}
}