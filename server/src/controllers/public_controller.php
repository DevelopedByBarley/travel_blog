<?php
function homeHandler()
{
    $trips = array_fill(0, 12, [
        "tripId" => 0,
        "title" => "test title",
        "description" => "Lorem ipsum dolor sit 
                        amet consectetur adipisicing elit. Earum autem magnam
                        molestiae aspernatur blanditiis laborum mollitia r
                        epellendus dolorum, maiores, incidunt, a nisi doloremqu
                        e iste accusamus nihil! Earum quas eveniet consectetur.",
        "time" => time(),
        "tripImages" => [
            "forest.jpg",
            "header_background.jpg",
            "mountains.jpg",
            "snow-mountain.jpg",
        ],
        "adminId" => 1
    ]);

    echo render("wrapper.php", [
        "content" => render("pages/public/main_page.php", [
            "latestTrips" =>  array_slice($trips, 0, 3),
            "anotherTrips" => array_slice($trips, 0, 6),
            "bucketList" => array_slice($trips, 0, 6)
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
