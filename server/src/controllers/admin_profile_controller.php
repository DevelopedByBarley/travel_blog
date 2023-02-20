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
    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/admin_edit_profile_form.php", [
                "prevImage" => $_GET["prevImage"] ?? null
            ])
        ])
    ]);
}

function editAdminProfileHandler()
{

    if (isset($_GET["prevImage"])) unlink('./public/images/' . $_GET["prevImage"]);
    saveProfileImage($_FILES["file"]);
}


function saveProfileImage($file)
{
    $whiteList = [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF];

    if (!in_array(exif_imagetype($file['tmp_name']), $whiteList)) return false;

    $rand = uniqid(rand(), true);
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    $originalFileName = $rand . '.' . $ext;
    $directoryPath = "./public/images/";

    $isMoveSuccess = file_put_contents($directoryPath . $originalFileName, file_get_contents($file["tmp_name"]));

    $pdo = getConnection();
    $stmt = $pdo->prepare("UPDATE `profile` SET `name` = ?, `email` = ?, `age` = ?, `profileImage` = ?, `editedAt` = ? WHERE `profile`.`profileId` = ?;");
    $stmt->execute([
        $_POST["name"],
        $_POST["email"],
        $_POST["age"],
        $originalFileName,
        time(),
        0
    ]);

    header("Location: /admin/profile");
}
