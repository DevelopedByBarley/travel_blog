<?php
require './helpers/debug_console.php';
require '../../database/getConnection.php';
require './helpers/render.php';
require './controllers/public_controller.php';
require './controllers/admin_controller.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

$routes = [
    "GET" => [
        "/" => "homeHandler",
        "/trip-list" => "tripListHandler",
        "/trip-single" => "getSingleTripHandler",
        "/admin" => "adminHandler",
        "/admin/profile" => "adminProfileHandler",
        "/admin/profile-edit" => "editAdminProfileFormHandler",
        "/admin/dashboard" => "adminDashboardHandler",
        "/admin/trips" => "adminTripsHandler",
        "/admin/trip-single" => "adminTripSingleHandler",
        "/admin/logout" => "adminLogoutHandler",
        "/admin/new-trip" => "tripFormHandler",
        "/admin/delete-trip" => "deleteTripHandler",
        "/admin/edit-trip" => "editTripFormHandler",
    ],
    "POST" => [
        "/admin-register" => "adminRegisterHandler",
        "/admin-login" => "adminLoginHandler",
        "/admin/add-trip" => "adminAddTripHandler",
        "/admin/edit-trip" => "editTripHandler",
        "/admin/profile-edit" => "editAdminProfileHandler",
    ]
];

$handlerFunction = $routes[$method][$path] ?? "notFoundHandler";

$handlerFunction();





