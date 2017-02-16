<?php

return [

    /**
     * 菜单代理，默认代理是从本文件的menus项获取菜单，如果你是用数据库管理菜单，可以
     * 自定义菜单代理，返回相同格式的菜单数组
     */
    'agent'=>\Ricoa\Auth\Agent\DefaultMenusAgent::class,

    /**
     * 显示菜单的blade
     */
    'blade'=>'layouts.menu',

    /**
     * 全部菜单
     */
    'menus'=>[
        [
            'title'=>'首页',
            'action'=>'AdminController@index',
            'active'=>'admin'
        ],
        [
            'title'=>'权限管理',
            'sub'=>[
                [
                    'title'=>'所有权限',
                    'action'=>'\Ricoa\Auth\Controllers\PermissionController@index'
                ],
                [
                    'title'=>'所有角色',
                    'action'=>'\Ricoa\Auth\Controllers\RoleController@index'
                ],
                [
                    'title'=>'用户角色',
                    'action'=>'\Ricoa\Auth\Controllers\RoleUserController@index'
                ],

            ],
            'active'=>'admin/auth*'
        ],

    ],

    /**
     * 超级管理员账号，可以查看所有菜单和访问所有方法
     */
    'super'=>'super',

    /**
     * 路由属性
     */
    'routeAttributes'=>[
        'prefix'=>'admin/auth',
        'middleware'=>[
            'web',
            'auth'
        ]
    ],

    /**
     * 不进行权限判断的路由方法
     */
    'validateExcept'=>[
        'UserController@index'
    ]
];