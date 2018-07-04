<?php

namespace App\Http\Controllers\Icehouse\Networks;

use App\Model\Icehouse\Icehouse_hypervisors;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Icehouse\Icehouse_networks;
use App\Model\Icehouse\Icehouse_subnets;
use App\Model\Icehouse\Icehouse_floatingips;

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
     * NetworksController constructor.
     * @param Icehouse_networks    $model
     * @param Icehouse_subnets     $services
     * @param Icehouse_floatingips $floatingips
     */
    public function __construct(Icehouse_networks $model, Icehouse_subnets $services, Icehouse_floatingips $floatingips)
    {
        $this->model       = $model;
        $this->services    = $services;
        $this->floatingips = $services;
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
                $param1             = 'icehouse';
                $floating           = floatingips($param1, long2ip($lIP));
                $row                = array();
                $row['floating_ip'] = long2ip($lIP);
                $row['data']        = $floating;
                $aIPList[]          = $row;
            }
        }
    
        $res['success'] = 'success';
        $res['total']   = count($aIPList);
        $res['message'] = $aIPList;
        
        return response($res);
    }
}
