<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
declare(strict_types=1);

namespace App\Pool;

use Swoole\Coroutine;
use function Swoole\Coroutine\go;
use Swoole\Coroutine\WaitGroup;
use function Swoole\Coroutine\Co\run;

class DbPool
{
    protected $pool;
    protected $tables;

    public function __construct()
    {
        $config = config('database.mysql');
        $this->type = $config['type'];
        $class = "\App\Pool"."\\".$config['type'];
        $this->pool = $class::getInstance($config);

    }

    public function inasrt(array $array) :int {
        $pool =$this->pool;
        $sql =$this->arrayToSql($array);
        $wg = new WaitGroup();
        $ret = 0;
        $wg->add();//协程数量加1
        go(function () use ($pool,$sql,&$ret,$wg) {
            $mysql = $pool->conn();
            $statement = $mysql->prepare($sql);
            $statement->execute();

            $ret = (int) $mysql->lastInsertId();

            $pool->close($mysql);
            $wg->done();
        });
        //挂起父协程，等待所有子协程任务完成后恢复
        $wg->wait();
//        $ret =1;
        return $ret;
    }


    public function table($table){
        $this->tables = $table;
        return $this;
    }

    public function update(array $array):int {
        $pool =$this->pool;
        $sql =$this->arrayToSql($array,'update');
        $wg = new WaitGroup();
        $wg->add();
        $ret =0;
        go(function () use($pool,$sql,&$ret,$wg){
            $mysql = $pool->conn();
            $statement = $mysql->prepare($sql);
            $ret= $statement->execute();

            $pool->close($mysql);
            $wg->done();
        });
    }

    /**
     * 将数组转化为sql
     * @param $array
     * @param string $type
     * @param array $exclude
     * @return string
     */
    protected  function arrayToSql($array, $type='insert', $exclude = array())
    {
        $sql = '';
        if(count($array) > 0){
            foreach ($exclude as $exkey) {
                unset($array[$exkey]);
            }
            if('insert' == $type){
                $keys = array_keys($array);
                $values = array_values($array);
                $col = implode("`, `", $keys);
                $val = implode("', '", $values);
                $sql = "(`$col`) values('$val')";
                $sql = sprintf("INSERT INTO `%s`",$this->tables).$sql;
            }else if('update' == $type){
                $temparr = array();
                foreach ($array as $key => $value) {
                    $tempsql = "'$key' = '$value'";
                    $temparr[] = $tempsql;
                }
                $sql = implode(",", $temparr);
                $sql = sprintf("update `%s`",$this->tables).$sql;
            }
        }
        return $sql;
    }

}
