<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User\User;

class UserController extends Controller
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
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function get_user(Request $request, $id)
    {
        $user = $this->model->where('memberid', $id)->get();
        if ($user) {
            $res['success'] = true;
            $res['message'] = $user;
            
            return response($res);
        } else {
            $res['success'] = false;
            $res['message'] = 'Cannot find user!';
            
            return response($res);
        }
    }
}
