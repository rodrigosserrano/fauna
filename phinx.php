<?php

return
[
    'paths' => [
        'migrations' => 'application/db/migrations',
        'seeds' => 'application/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'fauna',
            'user' => 'fauna',
            'pass' => 'fauna@123',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'fauna',
            'user' => 'fauna',
            'pass' => 'fauna@123',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'fauna',
            'user' => 'fauna',
            'pass' => 'fauna@123',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
