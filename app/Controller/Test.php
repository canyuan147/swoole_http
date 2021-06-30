<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
namespace App\Controller;

use App\Pool\DbPool;

class Test extends Base {

    //数据库添加测试
    public function index($request, $response){

        $db = new DbPool();
        $res = $db->table('user')->inasrt(['name'=>2134]);
        $response->header('Content-Type', 'application/json');
        $response->end(message(array('id'=>$res),'请求Test/index数据成功',100));
    }

    public function test($request, $response){
        $response->header('Content-Type', 'application/json');
        $response->end(message(array('list'=>''),'请求Test/test数据成功',100));
    }
}