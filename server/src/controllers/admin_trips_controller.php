<?php




function adminTripsHandler()
{
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `trips`");
    $stmt->execute();
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/trip_list.php", [
                "trips" => $trips,
            ])
        ])
    ]);
}


function tripFormHandler()
{

    checkIsAdminLoggedInOrRedirect();
    $adminId = $_SESSION["adminId"];
    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/trip_form.php", [
                "adminId" => (int)$adminId,

            ])
        ])
    ]);
}

function adminAddTripHandler()
{


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


function adminTripSingleHandler()
{
    checkIsAdminLoggedInOrRedirect();

    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `trips` WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $trip = $stmt->fetch(PDO::FETCH_ASSOC);
    $tripContents = json_decode($trip["content"], true);
    $tripContentSchema = setTripContentsToSchema($tripContents);
    $ratingMessage = convertRatingToMessage((int)$trip["ratings"]);


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


function editTripFormHandler()
{
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `trips` WHERE id = ?");
    $stmt->execute([
        $_GET["id"] ?? ""
    ]);
    $trip = $stmt->fetch(PDO::FETCH_ASSOC);
    $prevImages = base64_encode($trip["images"]);



    echo render("wrapper.php", [
        "content" => render("pages/admin/admin_dashboard.php", [
            "innerContent" => render("pages/admin/admin_edit_trip_form.php", [
                "prevImages" => $prevImages,
                "id" => $_GET["id"],
                "trip" => $trip  
            ])
        ])
    ]);
}

function editTripHandler()
{


    $prevImages = base64_decode($_GET["images"]);
    $decoded = unserialize($prevImages);

    if (!empty($decoded)) {
        foreach ($decoded as $prevImage) {
            unlink("./public/images/" . $prevImage);
        }
    }




    $files = transformToSingleFiles($_FILES["files"]);

    $fileNames = [];
    foreach ($files as $file) {
        $fileNames[] = saveImage($file);
    }



    $pdo = getConnection();
    $stmt = $pdo->prepare("UPDATE `trips` SET 
    `title` = ?, 
    `description` = ?, 
    `content` = ?, 
    `images` = ?, 
    `time` = ?, 
    `ratings` = ?, 
    `summary` = ?, 
    `templateId` = ? 
    WHERE `trips`.`id` = ?");


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


function getTripContentHandler()
{
    checkIsAdminLoggedInOrRedirect();
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT `content` FROM `trips` WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);


    $tripContents = setTripContentsToSchema(json_decode($data["content"], true));

    echo json_encode($tripContents);
}
