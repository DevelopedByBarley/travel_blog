<?php

function tripFormHandler()
{
    checkIsAdminLoggedInOrRedirect();
    $adminId = $_SESSION["adminId"];
    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/trip_form.php", [
                "adminId" => (int)$adminId
            ])
        ])
    ]);
}

function adminAddTripHandler()
{
    if (!isset($_POST["title"]) || !isset($_POST["description"]) || !isset($_POST["content"]) || !isset($_POST["time"]) || !isset($_POST["ratings"])  || empty($_FILES["files"]["name"][0])) {
        header("Location: /admin/new-trip?isFailed=1");
        return;
    }


    $files = transformToSingleFiles($_FILES["files"]);

    $fileNames = [];
    foreach ($files as $file) {
        $fileNames[] = saveImage($file);
    }

    $pdo = getConnection();
    $stmt = $pdo->prepare("INSERT INTO `trips` (`id`, `title`, `description`, `content`, `images`, `time`, `ratings`, `templateId`, `adminId`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST["title"],
        $_POST["description"],
        json_encode($_POST["content"]),
        serialize($fileNames),
        $_POST["time"],
        $_POST["ratings"],
        (int)$_POST["templateId"],
        $_GET["id"],
    ]);

    header("Location: /admin/trips");
}


function deleteTripHandler()
{

    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT `images` FROM `trips` WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $images = unserialize($data["images"]);
    $directoryPath = "./public/images/";

    foreach ($images as $image) {
        unlink($directoryPath . $image);
    }

    $stmt = $pdo->prepare("DELETE FROM `trips` WHERE id = ?");
    $stmt->execute([
        $_GET["id"]
    ]);


    header("Location: /admin/trips");
}


function tripSingleHandler()
{
    checkIsAdminLoggedInOrRedirect();

    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `trips` WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $trip = $stmt->fetch(PDO::FETCH_ASSOC);
    $tripContents = json_decode($trip["content"], true);

    setTripContentsToSchema($tripContents); 


    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/templates/template_" . (int)$trip['templateId'] . ".php", [
                "trip" => $trip,
                "tripContents" => $tripContents
            ])
        ])
    ]);
}




function setTripContentsToSchema($schema) {
    $ret = [];
    foreach($schema as $key => $tripContents) {
       $tripFields = array_values($tripContents);
       $ret[] = [
        "title" => $tripFields[0],
        "paragraph_1" => $tripFields[1],
        "paragraph_2" => $tripFields[2],
        "paragraph_3" => $tripFields[3],
       ];
    }
    
    return $ret;

}


// Save images!;





function saveImage($file)
{
    $whiteList = [IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_PNG];

    if (!in_array(exif_imagetype($file["tmp_name"]), $whiteList)) return false;

    $rand = uniqid(rand(), true);
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    $originalFileName = $rand . '.' . $ext;
    $directoryPath = "./public/images/";

    file_put_contents($directoryPath . $originalFileName, file_get_contents($file["tmp_name"]));

    return $originalFileName;
}


function transformToSingleFiles($rawFiles)
{
    echo "<pre>";
    $ret = [];
    for ($i = 0; $i < count($rawFiles["name"]); $i++) {
        $ret[] = [
            'name' => $rawFiles['name'][$i],
            'type' => $rawFiles["type"][$i],
            'tmp_name' => $rawFiles["tmp_name"][$i],
            'size' => $rawFiles["size"][$i],
            'error' => $rawFiles["error"][$i],
        ];
    }
    return $ret;
}

