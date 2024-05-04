<?php
session_start();
require_once __DIR__ . '/../repo/User.php';

// Handle login form display
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include __DIR__ . '/../forms/registration_form.html';
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $name = $_POST["name"];
    $password = $_POST["password"];

    $user = [
        "name" => $name,
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "role" => USER_ROLE["user"]
    ];

    $db = Database::getInstance();
    $userObj = new User($db);
    $is_stored = $userObj->registration($user);
    if (!$is_stored) {
        header("Location:" . BASE_URL . "/user_registration");
        exit();
    }
    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] == USER_ROLE['admin']) {
        header("Location:" . BASE_URL . "/admin/dashboard");
        } else {
        header("Location:" . BASE_URL . "/user/dashboard");
        }
    }
  exit();
}

