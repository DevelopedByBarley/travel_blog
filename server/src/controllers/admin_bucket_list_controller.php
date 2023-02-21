<?php
function bucketFormHandler()
{
    checkIsAdminLoggedInOrRedirect();
    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/bucket_list_form.php", [])
        ])
    ]);
}

function newBucketHandler()
{
    checkIsAdminLoggedInOrRedirect();
    $adminId = $_SESSION["adminId"] ?? "";
    $originalFileName = saveImage($_FILES["file"]);

    $pdo = getConnection();
    $stmt = $pdo->prepare("INSERT INTO `bucketlist` (`bucketId`, `title`, `bucketImage`, `createdAt`, `adminId`) VALUES (NULL, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST["title"],
        $originalFileName,
        time(),
        $adminId
    ]);

    header("Location: /admin/bucketList");
}

function bucketListHandler()
{
    checkIsAdminLoggedInOrRedirect();
    $adminId = $_SESSION["adminId"] ?? "";
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `bucketlist` WHERE adminid = ?");
    $stmt->execute([
        $adminId
    ]);
    $bucketList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/bucket_list.php", [
                "bucketList" => $bucketList
            ])
        ])
    ]);
}

function deleteBucketHandler()
{
    checkIsAdminLoggedInOrRedirect();

    $pdo = getConnection();
    $stmt = $pdo->prepare("DELETE  FROM `bucketlist` WHERE bucketId = ?");
    $stmt->execute([
        $_GET["id"]
    ]);

    header("Location: /admin/bucketList");
}


function editBucketFormHandler()
{
    checkIsAdminLoggedInOrRedirect();
    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/edit_bucket_form.php", [
                "id" => $_GET["id"],
                "prevImage" => $_GET["prevImage"]
            ])
        ])
    ]);
}

function editBucketHandler()
{
    checkIsAdminLoggedInOrRedirect();
    //UPDATE `bucketlist` SET `title` = 'dsadasa', `bucketImage` = '146151213963f48a4c54c578.66172826d.jpg', `createdAt` = '167697057' WHERE `bucketlist`.`bucketId` = 10;
    if (isset($_GET["prevImage"])) unlink('./public/images/' . base64_decode($_GET["prevImage"]));

    $originalFileName = saveImage($_FILES["file"]);

    $pdo = getConnection();
    $stmt = $pdo->prepare("UPDATE `bucketlist` SET `title` = ?, `bucketImage` = ?, `createdAt` = ? WHERE `bucketlist`.`bucketId` = ?");
    $stmt->execute([
        $_POST["title"],
        $originalFileName,
        time(),
        (int)$_GET["id"]
    ]);

    header("Location: /admin/bucketList");
}
