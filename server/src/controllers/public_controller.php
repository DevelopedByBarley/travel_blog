<?php
function homeHandler()
{

    // All trips
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `trips`");
    $stmt->execute();
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Latest Trips
    $stmt = $pdo->prepare("SELECT * FROM `trips` ORDER BY id ASC LIMIT 6");
    $stmt->execute();
    $anotherTrips = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $stmt = $pdo->prepare("SELECT `name`, `profileImage` FROM `profile`");
    $stmt->execute();
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);

    echo render("wrapper.php", [
        "content" => render("pages/public/main_page.php", [
            "profile" => $profile,
            "trips" => $trips,
            "carouselTrips" => array_splice($trips, 0, 3),
            "anotherTrips" => $anotherTrips,
            "bucketList" => $trips
        ])
    ]);
}


function getSingleTripHandler()
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
        "content" => render("pages/templates/template_" . (int)$trip['templateId'] . ".php", [
            "trip" => $trip,
            "tripContents" => $tripContentSchema,
            "ratings" => $ratings,
        ])
    ]);
}



function tripListHandler()
{
    echo render("wrapper.php", [
        "content" => render("pages/public/trip_list.php", [])
    ]);
}



function notFoundHandler()
{
    echo render("wrapper.php", [
        "content" => render("pages/error/404.php")
    ]);
}
