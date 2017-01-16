<?php
namespace Ricoa\Auth\Services;


class MenusService{

    public function __construct()
    {
        $this->menus=config('menus.menus');
    }


    public function menusAll()
    {
        return $this->menus;
    }

    public function menusShow()
    {
        $user=\Auth::user();
        return $this->menusWithAuth($this->menus,$user);
    }

    protected function menusWithAuth($menus,$user){

        if($user->hasRole(config('menus.super','super'))){
            return $menus;
        }
        foreach ($menus as $key=> $menu){
            if(isset($menu['action'])){
                $action=explode("@",$menu['action']);
                if(!$user->can($menu['action'])&&!$user->can($action[0]."@*")){
                    unset($menus[$key]);
                }
            }else{
                if(isset($menu['sub'])){
                    $sub=$this->menusWithAuth($menu['sub'],$user);
                    if(!$sub){
                        unset($menus[$key]);
                    }else{
                        $menus[$key]['sub']=$sub;
                    }
                }else{
                    unset($menus[$key]);
                }
            }
        }

        return $menus;
    }
}