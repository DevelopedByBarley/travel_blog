<?php
require './validators/validators.php';
require './helpers/validate.php';
require './helpers/convertRatingToMessage.php';
require './helpers/setTripContentsToSchema.php';
require 'admin_trips_controller.php';
require 'admin_profile_controller.php';
require 'admin_bucket_list_controller.php';


function adminSchema()
{
    $adminSchema = [
        "email" => [required(), validateEmail()],
        "password" => [required(), validatePassword()]
    ];

    return toSchema($adminSchema);
}

function adminHandler()
{
    if (isLoggedIn()) {
        header('Location: /admin/dashboard');
    }

    $decodedErrors = json_decode(base64_decode($_GET["errors"] ?? ""), true);

    $errorMessages = getErrorMessages(adminSchema(), $decodedErrors);


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
