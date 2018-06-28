<?php

namespace App\Http\Controllers\Liberty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\liberty\icehouse_flavors;

class FlavourController extends Controller
{
    /**
     * @var icehouse_flavors
     */
    protected $model;
    
    /**
     * FlavourController constructor.
     * @param icehouse_flavors $model
     */
    public function __construct(icehouse_flavors $model)
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
