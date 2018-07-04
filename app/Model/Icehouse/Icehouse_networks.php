<?php

namespace App\Model\Icehouse;

use Illuminate\Database\Eloquent\Model;
use App\Model\Icehouse\Icehouse_subnets;

class Icehouse_networks extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'networkid', 'status', 'subnets', 'name', 'provider:physical_network', 'admin_state_up', 'tenant_id', 'mtu', 'provider:network_type', 'router:external', 'shared',
        'id', 'provider:segmentation_id', 'last_update'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    /**
     * @var bool timestamps
     */
    public $timestamps = false;
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subnets()
    {
        return $this->hasOne('App\Model\Icehouse\Icehousesubnets');
    }
}
