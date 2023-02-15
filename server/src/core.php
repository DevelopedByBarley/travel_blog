<?php
require '../../database/getConnection.php';
require './helpers/render.php';
require './controllers/public_controller.php';
require './controllers/admin_controller.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

$routes = [
    "GET" => [
        "/" => "homeHandler",
        "/admin" => "adminHandler",
        "/admin/dashboard" => "adminDashboardHandler",
        "/admin/trips" => "adminTripsHandler",
        "/admin/logout" => "adminLogoutHandler",
        "/admin/new-trip" => "tripFormHandler",
        "/tripList" => "tripListHandler"
    ],
    "POST" => [
        "/admin-register" => "adminRegisterHandler",
        "/admin-login" => "adminLoginHandler"
    ]
];

$handlerFunction = $routes[$method][$path] ?? "notFoundHandler";

$handlerFunction();





