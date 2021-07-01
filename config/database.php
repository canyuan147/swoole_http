<?php

return [
    'mysql'=>[
        'type'=>'Pdo',
        'host'=>'127.0.0.1',
        'port'=>3306,
        'coding'=>'utf8mb4',
        'dbname'=>'swoole',
        'username'=>'swoole',
        'password'=>'123456',
        'size'=>50,
    ],
    'redis'=>[
        'type'=>'Redis',
        'host'=>'127.0.0.1',
        'port'=>6379,
        'password'=>'',
        'db'=>0,
        'size'=>15,
        'timeout'=>1,
    ]
];
