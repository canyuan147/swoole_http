<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
declare(strict_types=1);

namespace App\Pool;

use Swoole\Database\RedisConfig;
use Swoole\Database\RedisPool;

class Redis extends PoolDb
{
    public function __construct($config)
    {
        $this->pool[$config['type']] = new RedisPool((new RedisConfig())
            ->withHost($config['host'])
            ->withPort($config['port'])
            ->withAuth($config['password'])
            ->withDbIndex($config['db'])
            ->withTimeout($config['timeout'])
            ,$config['size']);
    }

}
