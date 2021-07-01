<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
declare(strict_types=1);
namespace App\Pool;

class RedisPool {

    protected $pool;

    public function __construct()
    {
        $config =config('database.redis');
        $class = "\App\Pool"."\\".$config['type'];
        $this->pool=$class::getInstance($config);
    }

    public function conn(){
        return $this->pool->conn();
    }

    public function close($pool){
        $this->pool->close();
    }

    public function get($name){
        $redis = $this->conn();
        $data= $redis->get($name);
        $redis->close();
        return $data;
    }

    public function set($name,$value){
        $redis = $this->conn();
        $redis->set($name,$value);
        $redis->close();
    }

    public function inc($name){
        $redis = $this->conn();
        $redis->inc($name);
        $redis->close();
    }

    public function rm($name){
        $redis = $this->conn();
        $redis->rm($name);
        $redis->close();
    }

}
