<?php

namespace App\Http\Controllers\Icehouse\Images;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Icehouse\Icehouse_images;

class ImagesController extends Controller
{
    /**
     * @var Icehouse_hypervisors
     */
    protected $model;
    
    /**
     * ImagesController constructor.
     * @param Icehouse_images $model
     */
    public function __construct(Icehouse_images $model)
    {
        $this->model = $model;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function get_images(Request $request)
    {
        $data = $this->model->all();
        
        $result = array();
        foreach ($data as $row) {
            
            $row['name'] = isset($row->name) ? $row->name : 'Not Available';
            $result[]    = $row;
        }
        
        
        $res['success'] = 'success';
        $res['total']   = $row->count();
        $res['message'] = $result;
        
        return response($res);
    }
}
