<?php
session_start();
require_once __DIR__ . '/../repo/User.php';

if (isset($_SESSION['user_id'])) {
// Handle update form display
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        include __DIR__ . '/../process/user_update.php';
    }

// Handle login form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = [
            "name" => $_POST["name"],
            "email" => $_POST["email"],
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
            "role" => USER_ROLE["user"],
            "id" => $_POST["user_id"]
        ];

        $db = Database::getInstance();
        $userObj = new User($db);
        $is_updated = $userObj->updateUser($user);
        if (!$is_updated) {
            header("Location:" . BASE_URL . "/user_update");
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
}else{
    header("Location:" . BASE_URL . "/login");

    exit();
}
