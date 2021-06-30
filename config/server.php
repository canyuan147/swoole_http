<?php

return [

  'http_server'=>[
      'host' =>'0.0.0.0',
      'port' =>'9501'
  ],

  'tcp_server'=>[
    'host' =>'0.0.0.0',
    'port' =>'9502',
    'server'=>[
        'task_worker_num'=>4, //任务进程数量
        'daemonize'       => true,             //已守护进程执行该程序   //0 为调试模式 1 为 守护进程模式
        'max_request'     => 1000,       //worker进程最大任务数
        'dispatch_mode'   => 3,         //设置为争抢模式
        'task_ipc_mode'   => 3,         //设置为消息队列模式
    ]
  ]

];