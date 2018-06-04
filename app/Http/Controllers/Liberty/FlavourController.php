<?php

namespace App\Http\Controllers\Liberty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\liberty\liberty_flavors;

class FlavourController extends Controller
{
    /**
     * @var liberty_flavors
     */
    protected $model;
    
    /**
     * FlavourController constructor.
     * @param liberty_flavors $model
     */
    public function __construct(liberty_flavors $model)
    {
        $this->model = $model;
    }
    
    /**
     * GetFlavour data
     * @param Request $request
     */
    public function get_flavour(Request $request)
    {
        $data = $this->model->all();
        
        $res['success'] = 'success';
        $res['total']   = $data->count();
        $res['message'] = $data;
        
        return response($res);
    }
}
