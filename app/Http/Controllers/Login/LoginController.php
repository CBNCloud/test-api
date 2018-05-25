<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\User;

class LoginController extends Controller
{
    /**
     * @var User
     */
    protected $model;
    
    /**
     * LoginController constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    /**
     * Index login controller
     *
     * When user success login will retrive callback as api_token
     */
    public function index(Request $request)
    {
        $hasher          = app()->make('hash');
        $member_username = $request->input('member_username');
        $password        = md5($request->input('member_password'));
        
        $login = $this->model->where('member_username', $member_username)->first();
        if (!$login) {
            $res['success'] = false;
            $res['message'] = 'Your email or password incorrect!';
            
            return response($res);
        } else {
            if ($password == $login->member_password) {
                $api_token    = sha1(time());
                $create_token = $this->model->where('member_username', $login->member_username)->update(['api_token' => $api_token]);
                if ($create_token) {
                    $res['success']   = true;
                    $res['api_token'] = $api_token;
                    $res['message']   = $login;
                    
                    return response($res);
                }
            } else {
                $res['success'] = true;
                $res['message'] = 'You email or password incorrect!';
                
                return response($res);
            }
        }
    }
}
