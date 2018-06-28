<?php

namespace App\Http\Controllers\Icehouse\Hypervisors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Icehouse\Icehouse_hypervisors;

class HypervisorsController extends Controller
{
    /**
     * @var Icehouse_hypervisors
     */
    protected $model;
    
    /**
     * HypervisorsController constructor.
     * @param Icehouse_hypervisors $model
     */
    public function __construct(Icehouse_hypervisors $model)
    {
        $this->model = $model;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function get_hypervisors(Request $request)
    {
        $data = $this->model->all();
        
        $res['success'] = 'success';
        $res['total']   = $data->count();
        $res['message'] = $data;
        
        return response($res);
    }
}
