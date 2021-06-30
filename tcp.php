<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
define('APP_PATH',  __DIR__);
require APP_PATH . "/vendor/autoload.php";

use App\Server\Tcp;
$server = config('server');
$url = $server['tcp_server']['host'].":".$server['tcp_server']['port'];
echo $url."\n";
$Tcp = new Tcp();