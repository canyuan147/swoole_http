<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
namespace App\Server;

use Swoole\Client as Sw_Client;

class Client {

    private $Client;


    public function __construct()
    {
        $config = config('server');
        $this->Client = new Sw_Client(SWOOLE_SOCK_TCP);
        if (!$this->Client->connect($config['tcp_server']['host'],$config['tcp_server']['port'], -1)) {
            exit("connect failed. Error: {$this->Client->errCode}\n");
        }
    }

    public function send($data){
        $this->Client->send($data);
        $res =$this->Client->recv();
        $this->Client->close();
        return $res;
    }

}