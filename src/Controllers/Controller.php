<?php

namespace Ricoa\Auth\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        
    }

    public function rememberUrl(Request $request)
    {
        \Session::put($this->back_url,$request->getRequestUri());
    }

    public function redirectRememberUrl()
    {
        return redirect(session($this->back_url,$this->index_route));
    }
}
