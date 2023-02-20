<?php
function homeHandler()
{

    // All trips
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM `trips`");
    $stmt -> execute();
    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Latest Trips
    $stmt = $pdo->prepare("SELECT * FROM `trips` ORDER BY id ASC LIMIT 6");
    $stmt -> execute();
    $anotherTrips = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $stmt = $pdo->prepare("SELECT `name`, `profileImage` FROM `profile`");
    $stmt -> execute();
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);

    echo render("wrapper.php", [
        "content" => render("pages/public/main_page.php", [
            "profile" => $profile,
            "trips" => $trips,
            "anotherTrips" => $anotherTrips,
            "bucketList" => $trips
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
