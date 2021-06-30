<?php
return [
    '/'=>['GET','\App\Controller\Index','index'],
    '/index/test'=>['GET','\App\Controller\Index','test'],
    '/Test/index'=>['GET','\App\Controller\Test','index'],
    '/Test/test'=>['GET','\App\Controller\Test','test'],
    '/index/index'=>['POST','\App\Controller\Index','index'],
];