<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
namespace App\Controller;

class Base {

    //每个控制器都应该有的单例
    protected static  $init = [];

    public static function init($name){
        if(is_null(static::$init[$name])) {
            echo "加载".$name."控制器单例"."\n";
            static::$init[$name] = new $name();
            $cache = memory_get_usage();
            echo "当前使用内存:".$cache."\n";
        }
        return static::$init[$name];
    }

}