<?php
include(__DIR__.'/../../../../bootstrap.php');

return [
    "paths" => [
        "migrations" => lucid::$paths['base']."/db/migrations/",
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "development",
        "development" => lucid::$db_stages['development'],
        "qa" => lucid::$db_stages['qa'],
        "production" => lucid::$db_stages['production'],
    ],
];