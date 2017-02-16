<?php

use Ricoa\Auth\Agent\DefaultMenusAgent;

function can($user,$action){

    $agent=DefaultMenusAgent::getMenuAgent();

    if($agent->isSuperAdmin($user)){
        C($action,1);
        return true;
    }

    //判断权限
    $action = str_replace("App\\Http\\Controllers\\","",$action);
    $actions=explode("@",$action);

    //缓存
    if(C($actions[0])!==null){
        return C($actions[0]);
    }
    $excepts=config('menus.validateExcept',[]);

    if(!$user->can($action)
        && !$user->can($actions[0]."@_ALL")//支持UserController@_ALL形式（匹配UserController@index..等等）
        &&!$user->can($actions[0]."@*".$actions[1]."*")//支持UserController@index-create-store形式
        &&!in_array($action,$excepts) //不在排除列表里
    ){
        C($action,0);
        return false;
    }

    C($action,1);
    return true;
}

function C($key,$value=null){
    $key='user-'.$key;
    if($value===null){
        return config($key);
    }

    return config([$key=>$value]);
}