<?php

/**
 * phinx 数据库配置
 * cp phinx.example.php phinx.php
 */

require_once __DIR__ . '/classes/bootstrap.php';

return array(
    "paths" => array(
        "migrations" => "database/migrations",
        "seeds" => "database/seeds"
    ),
    "environments" => array(
        "default_migration_table" => "phinxlog",
        "default_database" => $env,
        $env => array(
            "adapter" => env('DB_DRIVER'),
            "host" => env("DB_HOST"),
            "name" => env("DB_DATABASE"),
            "user" => env("DB_USERNAME"),
            "pass" => env("DB_PASSWORD")
        )
    )
);