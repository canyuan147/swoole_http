<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
namespace App\Controller;

use App\Server\Client;

class Index extends Base {

    public function index($request, $response){
        $data['name'] =  $request->get['name'];
        $data = json_encode($data);
        $res = (new Client())->send($data);
        var_dump($res);
        $response->header('Content-Type', 'application/json');
        $response->end(message(array('list'=>''),'请求Index/index数据成功',100));
    }

    public function test($request, $response){
        $response->header('Content-Type', 'application/json');
        $response->end(message(array('list'=>''),'请求Index/test数据成功',100));
    }
}