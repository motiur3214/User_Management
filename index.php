<?php
require_once __DIR__ . '/vendor/autoload.php'; // Load Composer's autoloader
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/application');
$dotenv->load();
// Include necessary files
require_once __DIR__ . '/application/config.php';
require_once __DIR__ . '/application/repo/Database.php';
include __DIR__ . '/application/repo/User.php';
// Check if user_management is in the URI
if (str_contains($_SERVER['REQUEST_URI'], '/user_management')) {

    // Extract the remaining part of the URI after /user_management
    $uri_segment = explode('/user_management/', $_SERVER['REQUEST_URI'])[1] ?? '';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $user_id = $_GET['user_id'] ?? 0;
    // Handle specific routes within /user_management
    switch ($uri_segment) {
        case 'login':
        case '':
            // Include the login
            require_once 'application/validation/login.php';
            break;
        case 'dashboard':
            // dashboard validation
            include 'application/validation/dashboard.php';
            break;
        case 'admin/dashboard?page=' . $page:
        case 'admin/dashboard':
            // Admin dashboard with or without parameter
            include 'application/process/admin/admin_dashboard.php';
            break;
        case 'user/dashboard':
            // user Dashboard
            include 'application/process/user/user_dashboard.php';
            break;
        case 'user_registration':
            // registration route
            include 'application/validation/user_registration.php';
            break;
        case 'user_update?user_id=' . $user_id:
            // registration route
            include 'application/validation/user_update.php';
            break;
        case 'user_delete':
            // registration route
            include 'application/validation/user_delete.php';
            break;
        case 'logout':
            // logout route
            include 'application/validation/logout.php';
            break;
        default:
            echo "Invalid user_management route";
            break;
    }
} else {
    // Route not found
    http_response_code(404);
    echo "404 Not Found";
    exit();
}
