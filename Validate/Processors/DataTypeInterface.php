<?php

namespace Yohns\Validate\Processors;

interface DataTypeInterface {
	public function process(mixed $input, array $dataTypeSchema, array $rules): mixed;
}