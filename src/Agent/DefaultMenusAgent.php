<?php
namespace Ricoa\Auth\Agent;

class DefaultMenusAgent {

    /**
     * @var DefaultMenusAgent
     */
    private static $agent=null;

    /**
     * @return DefaultMenusAgent
     */
    static public function getMenuAgent(){

        if(self::$agent){
            return self::$agent;
        }

        try{
            self::$agent=app(config('menus.agent'));
        }catch (\Exception $e){
            self::$agent=app(self::class);
        }

        return self::$agent;
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