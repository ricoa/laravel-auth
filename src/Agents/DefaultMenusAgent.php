<?php
namespace Ricoa\Auth\Agents;

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
            if(config('menus.agent')){
                self::$agent=app(config('menus.agent'));
            }else{
                throw new \Exception("No Agent", 1);
            }
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
        if(C('superAdmin')!==null){
            return C('superAdmin');
        }
        if(!$user||!$user->hasRole(config('menus.super','super'))){
            C('superAdmin',0);
            return false;
        }
        C('superAdmin',1);

        return true;
    }
}