<?php

// Define database constants
define("DB_HOST", getenv('DATABASE_HOST') ?? $_ENV['DATABASE_HOST']);
define("DB_NAME", getenv('DATABASE_NAME') ?? $_ENV['DATABASE_NAME']);
define("DB_USERNAME", getenv('DATABASE_USER') ?? $_ENV['DATABASE_USER']);
define("DB_PASSWORD", getenv('DATABASE_PASSWORD') ?? $_ENV['DATABASE_PASSWORD']);
define("BASE_URL", getenv('BASE_URL') ?? $_ENV['BASE_URL']);

const USER_ROLE = [
    "admin" => 1,
    "user" => 2
];
