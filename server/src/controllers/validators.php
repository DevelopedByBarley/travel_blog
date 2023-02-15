<?php
    function required() {
        return [
            "validatorName" => "required",
            "validatorFn" => fn ($input) => (bool)$input,
            "params" => null
        ];
    }

    function validateEmail() {
        return [
            "validatorName" => "validateEmail",
            "validatorFn" => fn ($input) => filter_var($input, FILTER_VALIDATE_EMAIL),
            "params" => null
        ];
    }


    function validatePassword() {
        return [
            "validatorName" => "validatePassword",
            "validatorFn" => function($input) {
                $uppercase    = preg_match('@[A-Z]@', $input);
                $lowercase    = preg_match('@[a-z]@', $input);
                $number       = preg_match('@[0-9]@', $input);
                $specialchars = preg_match('@[^\w]@', $input);

                if(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($input) < 8) return false;
                return true;
            },
            "params" => null
        ];
    }
