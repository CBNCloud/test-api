<?php

namespace App\Http\Controllers\Icehouse\Flavours;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Icehouse\Icehouse_flavors;

class FlavoursController extends Controller
{
    /**
     * @var Icehouse_hypervisors
     */
    protected $model;
    
    /**
     * HypervisorsController constructor.
     * @param Icehouse_hypervisors $model
     */
    public function __construct(Icehouse_flavors $model)
    {
        $this->model = $model;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function get_flavours(Request $request)
    {
        $data = $this->model->all();
        
        $res['success'] = 'success';
        $res['total']   = $data->count();
        $res['message'] = $data;
        
        return response($res);
    }
}
