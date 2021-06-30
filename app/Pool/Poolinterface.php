<?php
/**
 * Created by PhpStorm
 * User: canyuan
 * Date: 2021/06/30
 * Time: 10:51
 */
namespace App\Pool;

interface Poolinterface{

    public function conn();

    public function close(object $pdo);
}
