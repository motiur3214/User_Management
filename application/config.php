<?php

// Define database constants
define("DB_HOST", $_ENV['DATABASE_HOST']);
define("DB_NAME", $_ENV['DATABASE_NAME']);
define("DB_USERNAME", $_ENV['DATABASE_USER']);
define("DB_PASSWORD", $_ENV['DATABASE_PASSWORD']);
define("BASE_URL", $_ENV['BASE_URL']);

const USER_ROLE = [
    "admin" => 1,
    "user" => 2
];
