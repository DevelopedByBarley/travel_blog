<?php
function getErrorMessages($schema, $errors)
{
    

    $adminValidatorNameToMessage = [
        "required" => fn ($value, $params) => "Mező kitöltése kötelező!",
        "validateEmail" => fn ($value, $params) => "Nem megfelelő email formátum!",
        "validatePassword" => fn ($value, $params) => "Jelszó erőssége nem megfelelő!"
    ];


    $ret = [];
    if (isset($errors)) {
        foreach ($errors as $fieldName => $errorsForField) {

            foreach ($errorsForField as $error) {
                $toMessageFunction = $adminValidatorNameToMessage[$error["validatorName"]];
                $schemaForErrors = $schema[$fieldName];
                $ret[$fieldName][] = $toMessageFunction($error["value"], $schemaForErrors[$error["validatorName"]]["params"]);
            }
        }
    }
    return $ret;
}


function validate($schema, $body)
{
    $fieldNames = array_keys($schema);
    $ret = [];

    foreach ($fieldNames as $fieldName) {
        $ret[$fieldName] = [];
    }

    foreach ($fieldNames as $fieldName) {
        $validators = $schema[$fieldName];

        foreach ($validators as $validator) {
            $validatorFn = $validator["validatorFn"];
            $isFieldValid = $validatorFn($body[$fieldName]) ?? null;
            echo "<pre>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            var_dump($isFieldValid);

            if (!$isFieldValid) {
                $ret[$fieldName][] = [
                    "validatorName" => $validator["validatorName"],
                    "value" => $body[$fieldName] ?? null
                ];
            }
        }
    }
    return $ret;
}


function toSchema($schema)
{

    $ret = [];

    foreach ($schema as $fieldName => $fields) {
        foreach ($fields as $field) {
            $ret[$fieldName][$field["validatorName"]] = $field;
        }
    }
    
    return $ret;
}
