<?php

namespace Ricoa\Auth\Middlewares;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Route;

class Permission
{
	protected $auth;

	/**
	 * Creates a new instance of the middleware.
	 *
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  Closure $next
	 * @param  $permissions
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $action = str_replace("App\\Http\\Controllers\\","",Route::currentRouteAction());
        $actions=explode("@",$action);        //处理UserController@*
        if ($this->auth->guest() || ((!$request->user()->hasRole(config('menus.super','super'))&&!$request->user()->can($action))&&!$request->user()->can($actions[0]."@*"))) {
			abort(403);
		}

		return $next($request);
	}
}
