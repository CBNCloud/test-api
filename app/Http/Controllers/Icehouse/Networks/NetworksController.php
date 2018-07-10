<?php

namespace App\Http\Controllers\Icehouse\Networks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Icehouse\Icehouse_networks;
use App\Model\Icehouse\Icehouse_subnets;
use App\Model\Icehouse\Icehouse_projects;
use App\Model\Icehouse\Icehouse_floatingips;
use App\Model\Icehouse\Icehouse_instances;

class NetworksController extends Controller
{
    /**
     * @var Icehouse_networks
     */
    protected $model;
    
    /**
     * @var Icehouse_subnets
     */
    protected $services;
    
    /**
     * @var Icehouse_floatingips
     */
    protected $floatingips;
    
    /**
     * @var Icehouse_projects
     */
    protected $usages;
    
    /**
     * @var Icehouse_instances
     */
    protected $instance;
    
    /**
     * NetworksController constructor.
     * @param Icehouse_networks    $model
     * @param Icehouse_subnets     $services
     * @param Icehouse_floatingips $floatingips
     * @param Icehouse_projects    $projects
     * @param Icehouse_instances   $instance
     */
    public function __construct(Icehouse_networks $model, Icehouse_subnets $services, Icehouse_floatingips $floatingips, Icehouse_projects $projects, Icehouse_instances $instance)
    {
        $this->model       = $model;
        $this->services    = $services;
        $this->floatingips = $floatingips;
        $this->projects    = $projects;
        $this->instance    = $instance;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function get_networks(Request $request)
    {
        $data = $this->model->where('router:external', '1')->first();
        
        //checking subnets
        $subnets             = $this->services->where('network_id', $data->id)->get();
        $json_encode_subnets = $subnets[0]->allocation_pools;
        $ip_start            = json_decode($json_encode_subnets)[0]->start;
        $ip_end              = json_decode($json_encode_subnets)[0]->end;
        
        $aIPList = array();
        if ((ip2long($ip_start) !== -1) && (ip2long($ip_end) !== -1)) // As of PHP5, -1 => False
        {
            for ($lIP = ip2long($ip_start); $lIP <= ip2long($ip_end); $lIP++) {
                $param1 = 'icehouse';
                
                $getproject = $this->floatingips->where('floating_ip_address', long2ip($lIP))->first();
                
                $tenant_id = isset($getproject->tenant_id) ? $getproject->tenant_id : '';
                
                if (!$getproject) {
                    $result          = '';
                    $result_instance = '';
                } else {
                    $getproject2 = $this->projects->where('id', $getproject->tenant_id)->first();
                    $result      = isset($getproject2->name) ? $getproject2->name : '';
                    
                    $get_instance    = $this->instance->where('tenant_id', $getproject->tenant_id)
                        ->where('addresses', 'like', "%" . $getproject->floating_ip_address . "%" )
                        ->first();
                    $result_instance = isset($get_instance->name) ? $get_instance->name : '';
                }
                $row['floating_ip']      = long2ip($lIP);
                $row['project_name']     = $result;
                $row['instance_name']    = $result_instance;
                $row['fixed_ip_address'] = isset($getproject->fixed_ip_address) ? $getproject->fixed_ip_address : '';
                $row['fixed_port_id']    = isset($getproject->port_id) ? $getproject->port_id : '';
                $row['router_id']        = isset($getproject->router_id) ? $getproject->router_id : '';
                $row['last_update']      = isset($getproject->last_update) ? $getproject->last_update : '';
                $row['status']           = isset($getproject->status) ? $getproject->status : '';
                
                $aIPList[] = $row;
            }
        }
        
        $res['success'] = 'success';
        $res['total']   = count($aIPList);
        $res['message'] = $aIPList;
        
        return response($res);
    }
    
    /**
     * @param $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function show_networks($id)
    {
        
        $param1   = 'icehouse';
        $floating = floatingips($param1, $id);
        
        $res['success'] = 'success';
        $res['total']   = count($floating);
        $res['message'] = $floating;
        
        return response($res);
    }
}
