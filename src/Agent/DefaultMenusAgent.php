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
}