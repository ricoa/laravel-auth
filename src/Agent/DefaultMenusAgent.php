<?php
namespace Ricoa\Auth\Agent;

class DefaultMenusAgent {

    /**
     * @return DefaultMenusAgent
     */
    static public function getMenuAgent(){
        try{
            return app(config('menus.agent'));
        }catch (\Exception $e){
            return app(self::class);
        }
    }

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