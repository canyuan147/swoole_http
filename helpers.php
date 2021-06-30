<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
/**
 * 参数类型判断.
 * @param array $array
 * @param $effect_array
 *
 * @return bool
 */
if(!function_exists('intended_effect')){
    function intended_effect(array $array, $effect_array)
    {
        if ([] == array_diff($array, $effect_array)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * 获取配置
 * @param string $name
 * @return array
 */
if(!function_exists('config')){

    function config(string $name)
    {
        return  get_path('/config/',$name);
    }
}



/**
 * @param string $name
 * @return string
 */

if(!function_exists('get')){
    function get_path($path,string $name,$fix='php')
    {
        if($fix == 'html'){
            return __DIR__.$path.$name.'.'.$fix;
        }
        $config_name = explode('.',$name);
        $data = [];
        foreach ($config_name as $key=> $value){
            if($key == 0){
                $data = require __DIR__.$path.$value.'.'.$fix;
            }else{
                if($key+1 == count($config_name)){
                    return $data[$value];
                }else{
                    $data=$data[$value];
                }
            }
        }
        return $data;
    }
}

if(!function_exists('message')){
    function message(array $data=[],string $message='success',int $code=200)
    {
        return json_encode([
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        ],JSON_UNESCAPED_UNICODE);
    }
}