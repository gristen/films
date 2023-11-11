<?php

namespace App\Kernel\Validator;

class Validator
{
    private array $errors = [];

    private array $data;

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        $this->data = $data;

        foreach ($rules as $key => $rule) {

            $rules = $rule;
            foreach ($rules as $rule) {

                $rule = explode(':', $rule);

                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;
                $error = $this->validateRule($key, $ruleName, $ruleValue);

                if ($error) {
                    $this->errors[$key][] = $error;
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function validateRule(string $key, string $ruleName, string $ruleValue = null): string|false
    {
        $value = $this->data[$key];

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    return 'Field is required';

                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue) {
                    return 'мало символов';
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue) {
                    return 'много символов';
                }
                break;
        }

        return false;
    }
}
