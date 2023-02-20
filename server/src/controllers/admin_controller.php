<?php
require 'validators.php';
require 'admin_trips_controller.php';
require 'admin_profile_controller.php';

function adminHandler()
{
    if (isLoggedIn()) {
        header('Location: /admin/dashboard');
    }

    $decodedErrors = json_decode(base64_decode($_GET["errors"] ?? ""), true);

    $errorMessages = getAdminErrorMessages(adminSchema(), $decodedErrors);


    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_form.php", [
            "errorMessages" => $errorMessages ?? "",
            "isLoginFailed" => $_GET["isLoginFailed"] ?? null
        ])
    ]);
}




function adminDashboardHandler()
{
    checkIsAdminLoggedInOrRedirect();

    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [])
    ]);
}






function adminRegisterHandler()
{

    $pdo = getConnection();
    $stmt = $pdo->prepare("INSERT INTO `admin` (`id`, `email`, `password`) VALUES (NULL, ?, ?)");
    $stmt->execute([
        $_POST["email"],
        password_hash($_POST["password"], PASSWORD_DEFAULT)
    ]);

    echo "Admin created!";
}


function adminLoginHandler()
{

    $errors =  validate(adminSchema(), $_POST);
    $encodedErrors = base64_encode(json_encode($errors));

    foreach ($errors as $error) {
        if (!empty($error)) {
            header("Location: /admin?errors=$encodedErrors");
            return;
        }
    }


    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `admin` WHERE email = ?");
    $stmt->execute([
        $_POST["email"]
    ]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);




    if (!$admin) {
        header("Location: /admin?isLoginFailed=1");
        return;
    }

    $isVerified = password_verify($_POST["password"], $admin["password"]);

    if (!$isVerified) {
        header("Location: /admin?isLoginFailed=1");
        return;
    }

    session_start();
    $_SESSION["adminId"] = $admin["adminId"];

    header("Location: /admin/dashboard");
}


function adminLogoutHandler()
{
    session_start();
    session_destroy();

    $cookieParams = session_get_cookie_params();
    setcookie(session_name(), "", 0, $cookieParams["path"], $cookieParams["domain"], $cookieParams["secure"], isset($cookieParams["httponly"]));

    header('Location: /');
}




function isLoggedIn()
{
    if (!isset($_COOKIE[session_name()])) return false;
    session_start();
    if (!isset($_SESSION["adminId"])) return false;
    return true;
}




function checkIsAdminLoggedInOrRedirect()
{
    if (isLoggedIn()) {
        return;
    }
    header("Location: /");
}


function adminSchema()
{
    $adminSchema = [
        "email" => [required(), validateEmail()],
        "password" => [required(), validatePassword()]
    ];

    return toSchema($adminSchema);
}

function getAdminErrorMessages($schema, $errors)
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

