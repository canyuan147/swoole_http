<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
    define('APP_PATH',  __DIR__);
    require APP_PATH . "/vendor/autoload.php";

    use App\Server\Http;
    $http = new Http();
    $server = config('server');
    $url = $server['http_server']['host'].":".$server['http_server']['port'];
    echo $url."\n";
    $http->httpRequest()->start();