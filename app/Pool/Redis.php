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

class Redis implements Poolinterface
{
    protected static $instance ;

    protected $pool ;

    public static function getInstance($config=[])
    {
        if(is_null(static::$instance)) {
            static::$instance = new self($config);
        }
        return static::$instance;
    }

    public function conn(){
        return $this->pool->get();
    }

    public function close(object $pdo){
        return $this->pool->put($pdo);
    }

    public function __construct($config)
    {
        $this->pool= new RedisPool((new RedisConfig())
            ->withHost($config['host'])
            ->withPort($config['port'])
            ->withAuth($config['password'])
            ->withDbIndex($config['db'])
            ->withTimeout($config['timeout'])
            ,$config['size']);
    }

}
