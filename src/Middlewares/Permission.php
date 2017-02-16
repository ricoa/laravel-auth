<?php

namespace Ricoa\Auth\Middlewares;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Ricoa\Auth\Agent\DefaultMenusAgent;
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
        if ($this->auth->guest() ||!can($request->user(),Route::currentRouteAction())){
            abort(403);
        }
		return $next($request);
	}
}
