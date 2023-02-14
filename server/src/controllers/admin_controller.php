<?php
function adminHandler()
{
    if (isLoggedIn()) {
        header('Location: /admin/dashboard');
    }

    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_form.php", [])
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

    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `admin` WHERE email = ?");
    $stmt->execute([
        $_POST["email"]
    ]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        echo "email or password is doesn't exist!";
        return;
    }

    $isVerified = password_verify($_POST["password"], $admin["password"]);

    if (!$isVerified) {
        echo "email or password is doesn't exist!";
        return;
    }

    session_start();
    $_SESSION["adminId"] = $admin["id"];

    header("Location: /admin/dashboard");
}

function adminDashboardHandler()
{
    checkIsAdminLoggedInOrRedirect();

    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php")
    ]);
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
