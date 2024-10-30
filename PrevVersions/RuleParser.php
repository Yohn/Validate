<?php
namespace Yohns\Validate\Input;

class RuleParser
{
	// Define a set of valid rules for the custom validation system
	private $customRules = [
		'required', 'nullable', 'min', 'max', 'email', 'unique', 'confirmed', 'regex',
		'alpha_dash', 'integer', 'string', 'boolean', 'date', 'image', 'file', 'mime',
		'size', 'digits', 'active_url', 'exists', 'gt', 'lt', 'alpha', 'alpha_num',
		'starts_with', 'ends_with', 'uuid'
	];

	// Function to parse and validate the custom validation string
	public function parse($ruleString): array {
		$rules = explode('|', $ruleString); // Split the rule string by '|'
		$parsedRules = [];
		$errors = [];

		foreach ($rules as $rule) {
			// Handle rules with parameters, e.g., max(255) or unique(users.username)
			if (strpos($rule, '(') !== false) {
				[$ruleName, $params] = $this->extractRuleAndParams($rule);
			} else {
				$ruleName = $rule;
				$params = null;
			}

			// Validate if the rule is in the custom set of rules
			if (in_array($ruleName, $this->customRules)) {
				$parsedRules[] = ['rule' => $ruleName, 'params' => $params];
			} else {
				$errors[] = "Invalid rule: $ruleName";
			}
		}

		return [
			'parsed' => $parsedRules,
			'errors' => $errors
		];
	}

	// Function to extract rule and its parameters using parentheses '()'
	private function extractRuleAndParams($rule)
	{
		// Extract rule name and parameter within parentheses, e.g., max(255)
		preg_match('/(.+)\((.+)\)/', $rule, $matches);
		$ruleName = $matches[1] ?? $rule;
		$params = $matches[2] ?? null;

		return [$ruleName, $params];
	}
}

// Example usage
$validationRules = [
	'username' 		=> 'required|alpha_dash|min(5)|max(20)|unique(users.username)',
	'email'				=> 'required|email|unique(users.email)',
	'password' 		=> 'required|min(8)|confirmed',
	'profile_pic' => 'nullable|image|mime(image/jpg,image/jpeg,image/png,image/gif,image/webp)|max(2048)',
	'bio'	  			=> 'nullable|max(500)',
	'age'	  			=> 'required|integer|gt(17)'
];

$parser = new CustomValidationParser();

// Loop through validation rules and parse
foreach ($validationRules as $field => $ruleString) {
	$result = $parser->parse($ruleString);
	echo "\nField: $field\n";
	echo "Parsed Rules:\n";
	print_r($result['parsed']);
	if (!empty($result['errors'])) {
		echo "Errors:\n";
		print_r($result['errors']);
	}
}
