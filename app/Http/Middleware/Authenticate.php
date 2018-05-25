<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Model\User\User;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;
    
    /**
     * @var User
     */
    protected $model;
    
    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory $auth
     * @return void
     */
    public function __construct(Auth $auth, User $model)
    {
        $this->auth  = $auth;
        $this->model = $model;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            if ($request->header('api-token')) {
                $token       = $request->input('api-token');
                $check_token = $this->model->where('api_token', $token)->first();
                if ($check_token == null) {
                    $res['success'] = false;
                    $res['message'] = 'Permission not allowed!';
                
                    return response($res);
                }
            } else {
                $res['success'] = false;
                $res['message'] = 'Login please!';
            
                return response($res);
            }
        }
    
        return $next($request);
    }
}
