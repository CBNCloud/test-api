<?php

namespace App\Http\Controllers\Icehouse\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Icehouse\Icehouse_users;

class UsersController extends Controller
{
    /**
     * @var Icehouse_users
     */
    protected $model;
    
    /**
     * UsersController constructor.
     * @param Icehouse_users $model
     */
    public function __construct(Icehouse_users $model)
    {
        $this->model = $model;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function get_users(Request $request)
    {
        $data = $this->model->all();
        
        $res['success'] = 'success';
        $res['total']   = $data->count();
        $res['message'] = $data;
        
        return response($res);
    }
}
