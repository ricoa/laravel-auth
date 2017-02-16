<?php
namespace Ricoa\Auth\Agent;

class DefaultMenusAgent implements MenusAgentInterface {

    /**
     * @return array
     */
    public function menus()
    {
        return config('menus.menus');
    }
}