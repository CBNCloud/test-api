<?php

namespace App\Http\Controllers\Icehouse\Usages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Icehouse\Icehouse_usages;
use App\Model\Icehouse\Icehouse_projects;
use App\Model\Icehouse\Icehouse_usage_servers;

class UsageController extends Controller
{
    /**
     * @var Icehouse_usages
     */
    protected $model;
    
    /**
     * @var Icehouse_projects
     */
    protected $projects;
    
    /**
     * @var Icehouse_usage_servers
     */
    protected $usages;
    
    /**
     * UsageController constructor.
     * @param Icehouse_usages        $model
     * @param Icehouse_projects      $projects
     * @param Icehouse_usage_servers $usages
     */
    public function __construct(Icehouse_usages $model, Icehouse_projects $projects, Icehouse_usage_servers $usages)
    {
        $this->model    = $model;
        $this->projects = $projects;
        $this->usages   = $usages;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function get_usages(Request $request)
    {
        $data   = $this->model->all();
        $result = array();
        foreach ($data as $row) {
            
            $getproject      = $this->projects->where('id', $row->tenant_id)->first();
            $row['customer'] = isset($getproject->name) ? $getproject->name : '';
            $result[]        = $row;
        }
        
        $res['success'] = 'success';
        $res['total']   = $row->count();
        $res['message'] = $result;
        
        return response($res);
    }
}
