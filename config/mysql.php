<?php

return [
    'host' => getenv('MYSQL_HOST') ?: 'localhost',
    'database' => getenv('MYSQL_DATABASE') ?: 'mplatform',
    'username' => getenv('MYSQL_USERNAME') ?: 'mplatform',
    'password' => getenv('MYSQL_PASSWORD') ?: 'mplatform',
];
