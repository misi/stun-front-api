<?php
return [
    'settings' => [
        // Slim Settings
        'displayErrorDetails' => true, // set to false in production

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // database settings
        'pdo' => [
            'dsn' => 'mysql:host=localhost;charset=utf8mb4;collation=utf8mb4_unicode_ci',
            'username' => 'db_user',
            'password' => 'db_password',
            'options'=> [ PDO::ATTR_FETCH_TABLE_NAMES => 'true',
                          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                        ],
        ],

        // Monolog settings
        'logger' => [
            'name' => 'Frontend REST API app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Phpmailer settings
        'phpmailer' => [
            'debug' => 0,
            'host' => 'localhost',
            'charset' => 'UTF-8',
            'from' => [
              'email' => 'stun-devops@listserv.niif.hu',
              'displayname' => 'Contact Webform',
            ],
            'to' => [
              'email' => 'stun-devops@listserv.niif.hu',
              'displayname' => 'Contact Webform',
            ],
            'subject' => 'Message from Contact Form',
            'acknowledgement' => [
              'subject' => 'Your feedback is highly Appreciated!',
              'body' => 'Many thanks for Your feedback, we will contact you soon..',
              'altbody' => 'Many thanks for Your feedback, we will contact you soon..',
            ],
        ],

        // ResourceServer
        'resourceserver' => [
            'publickey' => '../public.key',
        ],

        // Actions & Scopes
        'scope' => [
            'ltc' => 'ltc',
            'rest' => 'rest',
            'oauth' => 'oauth',
            'general' => 'general',
        ],

        // Databases
        'db' => [
            'ltc' => 'coturn-ltc',
            'rest' => 'coturn-rest',
            'oauth' => 'oauth-rest',
        ],

    ],
];
