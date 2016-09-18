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
            'title'=>'测试',
            'sub'=>[
                [
                    'title'=>'测试',
                    'action'=>'AdminController@show'
                ],
                [
                    'title'=>'测试',
                    'action'=>'AdminController@test'
                ],

            ],
            'active'=>'admin*'
        ]
    ],

    /**
     * role who can see all menus
     */
    'super'=>'super'
];
