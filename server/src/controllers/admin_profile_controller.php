<?php


function adminProfileHandler()
{

    checkIsAdminLoggedInOrRedirect();
    $adminId = $_SESSION["adminId"] ?? "";
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `profile` WHERE adminId = ?");
    $stmt->execute([$adminId]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM `trips` WHERE adminId = ?");
    $stmt->execute([$admin["adminId"]]);
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);



    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/admin_profile.php", [
                "admin" => $admin,
                "trips" => count($trips)
            ])
        ])
    ]);
}

function editAdminProfileFormHandler()
{

    $pdo = getConnection();
    $stmt = $pdo -> prepare("SELECT * FROM `profile` WHERE profileId = ?");
    $stmt->execute([$_GET["id"]]);
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);


    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/admin_edit_profile_form.php", [
                "prevImage" => $_GET["prevImage"] ?? null,
                "id" => $_GET["id"],
                "profile" => $profile
            ])
        ])
    ]);
}

function editAdminProfileHandler()
{
    if (isset($_GET["prevImage"])) unlink('./public/images/' . $_GET["prevImage"]);
    $originalFileName = saveImage($_FILES["file"]);

    $pdo = getConnection();
    $stmt = $pdo->prepare("UPDATE `profile` SET `name` = ?, `email` = ?, `age` = ?, `profileImage` = ?, `editedAt` = ? WHERE `profile`.`profileId` = ?;");
    $stmt->execute([
        $_POST["name"],
        $_POST["email"],
        $_POST["age"],
        $originalFileName,
        time(),
        (int)$_GET["id"]
    ]);

    header("Location: /admin/profile");
}


