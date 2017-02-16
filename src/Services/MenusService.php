<?php
namespace Ricoa\Auth\Services;


use Ricoa\Auth\Agent\DefaultMenusAgent;

class MenusService{

    /**
     * @var DefaultMenusAgent
     */
    private $agent=null;

    public function __construct()
    {
        try{
            $this->agent=app(config('menus.agent'));
        }catch (\Exception $e){
            $this->agent=app(DefaultMenusAgent::class);
        }

        $this->menus=$this->agent->menus();
    }


    public function menusAll()
    {
        return $this->menus;
    }

    public function menusShow()
    {
        $user=\Auth::user();
        if($this->agent->isSuperAdmin($user)){
            return $this->menus;
        }
        return $this->menusWithAuth($this->menus,$user);
    }

    protected function menusWithAuth($menus,$user){

        foreach ($menus as $key=> $menu){
            if(isset($menu['action'])){
                if(!can($user,$menu['action'])){
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