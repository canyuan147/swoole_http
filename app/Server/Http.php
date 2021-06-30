<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
namespace App\Server;

use Swoole\Http\Server;

class Http {

    private $server;


    public function __construct()
    {
        $config = config('server');
        $this->server = new Server($config['http_server']['host'],$config['http_server']['port']);
    }

    public function httpRequest(){
        $this->server->on('Request', function ($request, $response) {
            $route = Route::init();
            $route->get($request,$response);
        });
        return $this;
    }

    public function start(){
        $this->server->start();
    }
}