<?php

namespace Yohns\Validate\Input;

use Exception;
use Yohns\Validate\Input\Rules\AfterDate;
use Yohns\Validate\Input\Rules\AfterDateTime;
use Yohns\Validate\Input\Rules\AfterTime;
use Yohns\Validate\Input\Rules\Age;
use Yohns\Validate\Input\Rules\Alpha;
use Yohns\Validate\Input\Rules\AlphaDash;
use Yohns\Validate\Input\Rules\AlphaNumeric;
use Yohns\Validate\Input\Rules\BeforeDate;
use Yohns\Validate\Input\Rules\BeforeDateTime;
use Yohns\Validate\Input\Rules\BeforeTime;
use Yohns\Validate\Input\Rules\Between;
use Yohns\Validate\Input\Rules\Boolean;
use Yohns\Validate\Input\Rules\Confirmed;
use Yohns\Validate\Input\Rules\Date;
use Yohns\Validate\Input\Rules\Datetime;
use Yohns\Validate\Input\Rules\Distinct;
use Yohns\Validate\Input\Rules\Email;
use Yohns\Validate\Input\Rules\File;
use Yohns\Validate\Input\Rules\Float;
use Yohns\Validate\Input\Rules\Image;
use Yohns\Validate\Input\Rules\InList;
use Yohns\Validate\Input\Rules\Int;
use Yohns\Validate\Input\Rules\Ip;
use Yohns\Validate\Input\Rules\Json;
use Yohns\Validate\Input\Rules\MaxLength;
use Yohns\Validate\Input\Rules\MaxSize;
use Yohns\Validate\Input\Rules\Mime;
use Yohns\Validate\Input\Rules\MinLength;
use Yohns\Validate\Input\Rules\MultiCollection;
use Yohns\Validate\Input\Rules\Nullable;
use Yohns\Validate\Input\Rules\Regex;
use Yohns\Validate\Input\Rules\Required;
use Yohns\Validate\Input\Rules\SingleCollection;
use Yohns\Validate\Input\Rules\Time;
use Yohns\Validate\Input\Rules\Url;
use Yohns\Validate\Input\Rules\WithinDateRange;
use Yohns\Validate\Input\Rules\WithinDateTimeRange;
use Yohns\Validate\Input\Rules\WithinTimeRange;
use Yohns\Validate\Input\Rules\Year;

/**
 * Class RuleFactory
 *
 * The RuleFactory class is responsible for managing validation rules.
 * It validates input data against defined rules and returns error messages if validations fail.
 *
 * @package Yohns\Validate\Input
 */
class RuleFactory
{
	protected array $errors = [];

	// Map rule names to their corresponding class
	protected array $ruleMap = [
													//# Validates if the date is after the specified date
		//!			 Format:		 afterdate(yyyy-mm-dd)
		'afterdate' 			=> AfterDate::class,
													//# Validates if the datetime is after the specified datetime
		//!			 Format:		 afterdatetime(yyyy-mm-dd hh:mm:ss)
		'afterdatetime' 	=> AfterDateTime::class,
													//# Validates if the time is after the specified time
		//!			 Format:		 aftertime(hh:mm:ss)
		'aftertime' 			=> AfterTime::class,
													//# Validates the age, with optional comparison operators
		//!			 Format:		 age(>=x) | age(>x) | age(=x) | age(<x) | age(<=x)
		'age' 						=> Age::class,
													//# Validates that the field contains only alphabetic characters
		//!			 Format:		 alpha
		'alpha' 					=> Alpha::class,
													//# Validates that the field contains only alphabetic characters, numbers, dashes, and underscores
		//!			 Format:		 alphadash
		'alphadash' 			=> AlphaDash::class,
													//# Validates that the field contains only alphabetic and numeric characters
		//!			 Format:		 alphanumeric
		'alphanumeric' 		=> AlphaNumeric::class,
													//# Validates if the date is before the specified date
		//!			 Format:		 beforedate(yyyy-mm-dd)
		'beforedate' 			=> BeforeDate::class,
													//# Validates if the datetime is before the specified datetime
		//!			 Format:		 beforedatetime(yyyy-mm-dd hh:mm:ss)
		'beforedatetime' 	=> BeforeDateTime::class,
													//# Validates if the time is before the specified time
		//!			 Format:		 beforetime(hh:mm:ss)
		'beforetime' 			=> BeforeTime::class,
													//# Validates if the value is within a specific range for numeric types or string lengths
		//!			 Format:		 between(min,max)
		'between' 				=> Between::class,
													//# Validates that the field is a boolean (true, false, 1, 0, "yes", "no")
		//!			 Format:		 boolean
		'boolean' 				=> Boolean::class,
													//# Validates that the field matches another field (e.g., password confirmation)
		//!			 Format:		 confirmed(otherfieldname)
		'confirmed' 			=> Confirmed::class,
													//# Validates the date using MySQL's DATE format (YYYY-MM-DD)
		//!			 Format:		 date
		'date' 						=> Date::class,
													//# Validates the datetime using MySQL's DATETIME format (YYYY-MM-DD HH:MM:SS)
		//!			 Format:		 datetime
		'datetime' 				=> Datetime::class,
													//# Validates that the field contains only unique values in an array
		//!			 Format:		 distinct
		'distinct' 				=> Distinct::class,
													//# Validates that the field contains a valid email address
		//!			 Format:		 email
		'email'						=> Email::class,
													//# Validates that the last character is (alpha | alphanumeric | numeric | other )
		//!			 Format:		 endswith()
		'endswith' 				=> EndsWith::class,
													//# Validates if the field is a file upload
		//!			 Format:		 file
		'file'						=> File::class,
													//# Validates if the field contains a floating-point number, with optional range checks
		//!			 Format:		 float | float(<x) | float(>x)
		'float'						=> Float::class,	// float|float(<10)|float(>3)|float(3><10)
													//# Validates that the field is an uploaded image file
		//!				Format:		 image
		'image' 					=> Image::class,
													//# Validates that the field contains a value from a predefined list
		//!			 Format:		 inlist(value1,value2,...)
		'inlist' 					=> InList::class,
													//# Validates if the field contains an integer, with optional range checks
		//!			 Format:		 int | int(<x) | int(>x)
		'int' 						=> Int::class,		// int|int(<10)|int(>3)|int(3><10)
													//# Validates that the field contains a valid IP address (IPv4 or IPv6)
		//!			 Format:		 ip
		'ip' 							=> Ip::class,
													//# Validates if the field contains valid JSON
		//!			 Format:		 json
		'json' 						=> Json::class,
													//# Validates that the field has a maximum length of characters
		//!			 Format:		 maxlength(x)
		'maxlength' 			=> MaxLength::class,
													//# Validates that the file size is below a certain size (in kilobytes)
		//!			 Format:		 maxsize(x) - x is the size limit in kb
		'maxsize' 				=> MaxSize::class,
													//# Validates that the file has one of the allowed MIME types
		//!			 Format:		 mime(mimetype1,mimetype2,...)
		'mime' 						=> Mime::class,
													//# Validates that the field has a minimum length of characters
		//!			 Format:		 minlength(x)
		'minlength' 			=> MinLength::class,
													//# Validates that the field contains multiple values from a collection
		//!			 Format:		 multicollection
		'multicollection' => MultiCollection::class,
													//# Validates if the field can be null or empty
		//!			 Format:		 nullable
		'nullable' 				=> Nullable::class,
													//# Validates that the field matches a specific regular expression
		//!			 Format:		 regex(pattern)
		'regex' 					=> Regex::class,
													//# Validates if the field is required (cannot be null or empty)
		//!			 Format:		 required
		'required'			 	=> Required::class,
													//# Validates that the field contains a single value from a collection
		//!			 Format:		 singlecollection
		'singlecollection' => SingleCollection::class,
													//# Validates that the first character is (alpha | alphanumeric | numeric | other )
		//!			 Format:		 startswith
		'startswith' 			=> StartsWith::class,
													//# Validates the time using MySQL's TIME format (HH:MM:SS)
		//!			 Format:		 time
		'time' 						=> Time::class,
													//# Validates that the field contains a valid URL
		//!			 Format:		 url
		'url' 						=> Url::class,
													//# Validates if the date is within a specified date range
		//!			 Format:		 withindaterange(startdate,enddate)
		'withindaterange' => WithinDateRange::class,
													//# Validates if the datetime is within a specified datetime range
		//!			 Format:		 withindatetimerange(startdatetime,enddatetime)
		'withindatetimerange' => WithinDateTimeRange::class,
													//# Validates if the time is within a specified time range
		//!			 Format:		 withintimerange(starttime,endtime)
		'withintimerange' => WithinTimeRange::class,
													//# Validates the year using MySQL's YEAR format (YYYY)
		//!			 Format:		 year
		'year'						=> Year::class,
		// Add more rules here
	];

	/**
	 * Validates an array of data against a set of rules.
	 *
	 * This function iterates over each field defined in the rules and applies
	 * the corresponding validation rules to its value. It records any errors
	 * encountered during validation.
	 * ```php
	 * $data = [
	 * 	'username' => 'My Submited Username',
	 * 	'email' => 'correctly@formatted.email', // should improve email validator to ensure email is really valid.
	 * ];
	 * $rules = [
	 * 	'username' => 'required|maxLength(30)|minlenth(3)',
	 * 	'email' => 'required|email|minlenth(5)',
	 * ];
	 * ```
	 *
	 * @param array $data Array of input data to be validated.
	 * @param array $rules Array of validation rules for each field.
	 *
	 * @return void
	 * @throws Exception If a validation rule is not supported.
	 */
	public function validate(array $data, array $rules): void {
		foreach ($rules as $field => $ruleSet) {
			$value = $data[$field] ?? null;
			$ruleStrings = explode('|', $ruleSet);
			foreach ($ruleStrings as $ruleString) {
				[$ruleName, $parameters] = $this->extractRuleAndParameters($ruleString);
				// Instantiate the rule class
				if (isset($this->ruleMap[$ruleName])) {
					$rule = new $this->ruleMap[$ruleName]();
					if (!$rule->validate($value, $parameters)) {
						$this->errors[$field][] = $rule->getErrorMessage();
					}
				} else {
					throw new Exception("Validation rule {$ruleName} not supported.");
				}
			}
		}

		return empty($this->errors);
	}

	/**
	 * Retrieves the recorded validation errors.
	 *
	 * This function provides access to the errors encountered during the
	 * validation process.
	 *
	 * @return array An associative array of errors for each field.
	 */
	public function getErrors(): array {
		return $this->errors;
	}

	/**
	 * Extracts the rule name and parameters from a rule string.
	 *
	 * If the rule string contains parameters, this method separates the
	 * rule name and the parameters for further validation processing.
	 *
	 * @param string $ruleString The rule string to extract from.
	 *
	 * @return array An array containing the rule name and parameters (or null).
	 */
	private function extractRuleAndParameters(string $ruleString): array {
		if (strpos($ruleString, '(') !== false) {
			preg_match('/(.+)\((.+)\)/', $ruleString, $matches);
			// dont lowercase perameters because collections might be capitalized
			return [strtolower($matches[1]), $matches[2]];
		}
		return [strtolower($ruleString), null];
	}
}
