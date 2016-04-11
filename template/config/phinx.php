<?php
include(__DIR__.'/../bootstrap.php');

return [
    "paths" => [
        "migrations" => __DIR__."/../dataase/migrations/",
        "seeds" => __DIR__."/../database/migrations/",
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "development",
        "development" => [
            'connection'=> \ORM::getDb(),
            'name'=>'development',
        ],
        "qa" => [
            'connection'=> \ORM::getDb(),
            'name'=>'qa',
        ],
        "production" => [
            'connection'=> \ORM::getDb(),
            'name'=>'production',
        ],
    ],
];