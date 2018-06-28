<?php

namespace App\Http\Controllers\Icehouse\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Icehouse\Icehouse_projects;

class ProjectsController extends Controller
{
    /**
     * @var Icehouse_projects
     */
    protected $model;
    
    /**
     * ProjectsController constructor.
     * @param Icehouse_projects $model
     */
    public function __construct(Icehouse_projects $model)
    {
        $this->model = $model;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function get_projects(Request $request)
    {
        $data = $this->model->all();
        
        $res['success'] = 'success';
        $res['total']   = $data->count();
        $res['message'] = $data;
        
        return response($res);
    }
}
