<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
namespace App\Server;


class Route {

    private array $routeconfiglist;

    private static $route;

    public function __construct()
    {
        $routeconfiglist = config('route');
        $this->routeconfiglist = $routeconfiglist;
    }

    public static function init()
    {
        if(is_null(static::$route)) {
            static::$route = new self();
        }
        return self::$route;
    }

    public function get(object $request,object $response){
        $method = $request->server['request_method'];
        $url = $request->server['request_uri'];
        if(empty($this->routeconfiglist[$url]) ||strtolower($this->routeconfiglist[$url][0]) != strtolower($method)){
            $response->header('Content-Type', 'application/json');
            $response->end(message(array(),'请求数据不存在',1300));
        }else{
            $action = $this->routeconfiglist[$url][2];
            $co = $this->routeconfiglist[$url][1];
            $co::init($co)->$action($request,$response);
        }
    }

}