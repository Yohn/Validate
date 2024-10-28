<?php

use Yohns\Utils\Validate\MySQLDataTypes;
use Yohns\Utils\Validate\ValException;

beforeEach(function () {
    // Common setup can go here if necessary
});

it('validates a valid TINYINT value', function () {
    $type = new MySQLDataTypes(1, 'TINYINT');
    expect($type->validate())->toBeTrue();
});

it('validates a valid DECIMAL value', function () {
    $type = new MySQLDataTypes('12.34', 'DECIMAL(5, 2)');
    expect($type->validate())->toBeTrue();
});

it('validates a valid VARCHAR value', function () {
    $type = new MySQLDataTypes('Hello', 'VARCHAR(10)');
    expect($type->validate())->toBeTrue();
});

it('throws an exception for invalid type format', function () {
    new MySQLDataTypes(100, 'INVALIDTYPE');
})->throws(ValException::class, 'Invalid type format: INVALIDTYPE');

it('throws an exception for out-of-range TINYINT value', function () {
    $type = new MySQLDataTypes(256, 'TINYINT');
    $type->validate();
})->throws(ValException::class, fn($exception) => str_contains($exception->getMessage(), 'Value must be between'));

it('throws an exception for invalid DECIMAL parameters', function () {
    new MySQLDataTypes('12.34', 'DECIMAL(5)');
})->throws(ValException::class, 'DECIMAL requires precision and scale parameters');

it('validates ENUM value correctly', function () {
    $type = new MySQLDataTypes('option1', "ENUM('option1', 'option2')");
    expect($type->validate())->toBeTrue();
});

it('throws an exception for invalid ENUM value', function () {
    $type = new MySQLDataTypes('invalid', "ENUM('option1', 'option2')");
    $type->validate();
})->throws(ValException::class, fn($exception) => str_contains($exception->getMessage(), 'Value must be one of:'));

it('validates SET value correctly', function () {
    $type = new MySQLDataTypes('option1, option2', "SET('option1', 'option2', 'option3')");
    expect($type->validate())->toBeTrue();
});

it('throws an exception for invalid SET value', function () {
    $type = new MySQLDataTypes('option4', "SET('option1', 'option2', 'option3')");
    $type->validate();
})->throws(ValException::class, fn($exception) => str_contains($exception->getMessage(), 'Invalid value'));

it('throws an exception for too many ENUM values', function () {
    $type = new MySQLDataTypes('value1', str_repeat("'value', ", 65536));
    $type->validate();
})->throws(ValException::class, fn($exception) => str_contains($exception->getMessage(), 'cannot have more than 65,535 values'));

it('throws an exception when the precision is out of range for DECIMAL', function () {
    new MySQLDataTypes('12.34', 'DECIMAL(100, 2)');
})->throws(ValException::class, fn($exception) => str_contains($exception->getMessage(), 'Precision must be between 1 and 65'));