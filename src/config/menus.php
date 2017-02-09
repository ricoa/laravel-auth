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
                [
                    'title'=>'用户角色',
                    'action'=>'\Ricoa\Auth\Controllers\RoleUserController@index'
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
    ],

    /**
     *  don't validate auth in those action
     */
    'validateExcept'=>[
        'UserController@index'
    ]
];