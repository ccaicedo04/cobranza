<?php
class Validation
{
    public static function make(array $data, array $rules): array
    {
        $errors = [];
        foreach ($rules as $field => $ruleStr) {
            $rulesArr = explode('|', $ruleStr);
            foreach ($rulesArr as $rule) {
                if ($rule === 'required' && (!isset($data[$field]) || trim($data[$field]) === '')) {
                    $errors[$field][] = 'required';
                } elseif ($rule === 'email' && isset($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = 'email';
                }
            }
        }
        return $errors;
    }
}
