<?php
session_start();
// routes/login.php
require_once __DIR__ . '/../repo/User.php';

// Handle login form display
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include __DIR__ . '/../forms/login_form.html';
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $db = Database::getInstance();
    $userObj = new User($db);
    $user = $userObj->login($email, $password);

    if ($user) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_role"] = $user['role'];
        header("Location:" . BASE_URL . "/dashboard");
    } else {
        header("Location:" . BASE_URL . "/login");
    }
    exit();
}

