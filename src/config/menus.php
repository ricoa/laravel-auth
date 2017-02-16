<?php

return [

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