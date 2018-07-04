<?php

namespace App\Model\Icehouse;

use Illuminate\Database\Eloquent\Model;

class Icehouse_subnets extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subnetsid', 'name', 'enable_dhcp', 'network_id', 'tenant_id', 'dns_nameservers', 'allocation_pools', 'host_routes', 'ip_version', 'gateway_ip',
        'cidr', 'id', 'last_update'
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
    public function networks()
    {
        return $this->hasOne('App\Model\Icehouse\Icehousenetworks', 'foreign_key', 'network_id');
    }
}
