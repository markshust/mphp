<?php

use App\Models\Migration;
use App\Model;
use App\Mysql;
use App\Router;
use App\Models\User;

use function Di\create;

return [
    'migrations' => create(Migration::class),
    'model' => create(Model::class),
    'mysql' => create(Mysql::class),
    'router' => create(Router::class),
    'users' => create(User::class),
];
