<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
namespace App\Server;

use Swoole\Server;

class Tcp {

    private $server;


    public function __construct()
    {
        $config = config('server');
        $this->server = new Server($config['tcp_server']['host'],$config['tcp_server']['port']);
        $this->server->set($config['tcp_server']['server']);

        //监听数据接收事件
        $this->server->on('Receive',[$this,'onReceive']);
        //处理异步任务(此回调函数在task进程中执行)
        $this->server->on('Task',[$this,'onTask']);
        //处理异步任务的结果(此回调函数在worker进程中执行)
        $this->server->on('Finish',[$this,'onFinish']);

        //启动服务器
        $this->server->start();
    }

    public function onConnect($server, $fd){
        echo "Client: Connect.\n";
    }

    public function onReceive($server, $fd, $reactor_id, $data){
        $data = json_decode($data,true);
        echo $data['name']."\n";
        $task_id = $server->task($data);
        $server->send($fd, "Server:".$task_id);
    }

    public function onTask($server, $task_id, $reactor_id, $data){
        echo "New AsyncTask[id={$task_id}]".PHP_EOL;
        //返回任务执行的结果
        $server->finish("{$data} -> OK");
    }

    public function onFinish($server, $task_id, $data){
        echo "AsyncTask[{$task_id}] Finish: {$data}".PHP_EOL;
    }

    public function onClose($server, $fd){
        echo "Client: Close.\n";
    }





}