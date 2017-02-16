<?php
namespace Ricoa\Auth\Agent;

class DefaultMenusAgent {

    /**
     * @return array
     */
    public function menus()
    {
        return config('menus.menus');
    }


    /**
     * @return boolean
     */
    public function isSuperAdmin($user=null)
    {
        if(!$user){
            return false;
        }
        return $user->hasRole(config('menus.super','super'));
    }
}