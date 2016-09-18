<?php

$attributes = array_merge([
    'prefix' => 'admin/auth',
], config('menus.routeAttributes', []));

Route::group($attributes,function(){

    Route::resource('permissions', '\Ricoa\Auth\Controllers\PermissionController');
    Route::resource('roles', '\Ricoa\Auth\Controllers\RoleController');
    Route::get('/roles/{id}/permissions', '\Ricoa\Auth\Controllers\RoleController@permissions')->name("roles.permissions");
    Route::post('/roles/{id}/permissions', '\Ricoa\Auth\Controllers\RoleController@permissionsUpdate');
});