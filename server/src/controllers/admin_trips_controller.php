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
    $stmt = $pdo->prepare("INSERT INTO `trips` (`id`, `title`, `description`, `content`, `images`, `time`, `ratings`, `summary`, `templateId`, `adminId`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST["title"],
        $_POST["description"],
        json_encode($_POST["content"]),
        serialize($fileNames),
        strtotime($_POST["time"]),
        $_POST["ratings"],
        $_POST["summary"],
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
    $tripContentSchema = setTripContentsToSchema($tripContents);

    switch ((int)$trip["ratings"]) {
        case 1:
            $ratingMessage = "Rossz élmény,  senkinek sem ajánlom!";
            break;
        case 2:
            $ratingMessage = "Rossz volt, de rosszabbul is járhattam volna!";
            break;
        case 3:
            $ratingMessage = "Nem volt rossz, de ha van más választásod nem ajánlanám!";
            break;
        case 4:
            $ratingMessage = "Kellemes élmény volt, menj el havan rá lehetőséged!";
            break;
        case 5:
            $ratingMessage = "Nagyszerű élmény volt, mindenképp menj el!";
            break;
        default:
            null;
    }

    $ratings = [
        "stars" => array_fill(0, (int)$trip["ratings"], ""),
        "message" => $ratingMessage
    ];

    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/templates/template_" . (int)$trip['templateId'] . ".php", [
                "trip" => $trip,
                "tripContents" => $tripContentSchema,
                "ratings" => $ratings,
            ])
        ])
    ]);
}




function setTripContentsToSchema($schema)
{
    $ret = [];
    foreach ($schema as $key => $tripContents) {
        $tripFields = array_values($tripContents);
        $ret[] = [
            "title" => $tripFields[0],
            "paragraphs" => [
                "paragraph_1" => $tripFields[1],
                "paragraph_2" => $tripFields[2],
                "paragraph_3" => $tripFields[3],
            ]
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
