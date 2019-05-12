<?php

return [
    'paths' => [
        'migrations' => ETC_PATH . '/db/migrations'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'local',
        'local' => \Sys\Context::getPhinxConnection()
    ]
];

