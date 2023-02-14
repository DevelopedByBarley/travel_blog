<?php
require '../../database/getConnection.php';
require './helpers/render.php';
require './controllers/admin_controller.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

$routes = [
    "GET" => [
        "/" => "homeHandler",
        "/admin" => "adminHandler",
        "/admin/dashboard" => "adminDashboardHandler"
    ],
    "POST" => [
        "/admin-register" => "adminRegisterHandler",
        "/admin-login" => "adminLoginHandler"
    ]
];

$handlerFunction = $routes[$method][$path] ?? "notFoundHandler";

$handlerFunction();

function homeHandler() {
    echo render("wrapper.php", [
        "content" => render("pages/public/travel_blog.php")
    ]);
}

function notFoundHandler() {
    echo "Route doesn't exist";
}



