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
                    return "Поле $key пустое";
                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue) {
                    return "Поле $key должно содержать не менее 3 символов";
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue) {
                    return "Поле $key не должно быть более 255 символов";
                }
                break;
        }

        return false;
    }
}
