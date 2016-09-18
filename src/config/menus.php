<?php

return [

    /**
     * blade to show menus
     */
    'blade'=>'layouts.menu',

    /**
     * all menus
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

            ],
            'active'=>'admin/auth*'
        ],

    ],

    /**
     * role who can see all menus
     */
    'super'=>'super',

    /**
     * route attributes
     */
    'routeAttributes'=>[
        'prefix'=>'admin/auth',
        'middleware'=>[
            'web',
            'auth'
        ]
    ]

];