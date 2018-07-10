<?php

namespace App\Model\Icehouse;

use Illuminate\Database\Eloquent\Model;

class Icehouse_instances extends Model
{
    /**
     * @var string table cmp_member
     */
    protected $table = 'icehouse_instance';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'instance_id', 'status', 'updated', 'hostId', 'OS-EXT-SRV-ATTR:host', 'addresses', 'links', 'key_name', 'image', '	OS-EXT-STS:task_state', 'OS-EXT-STS:vm_state',
        'OS-EXT-SRV-ATTR:instance_name', 'OS-SRV-USG:launched_at', 'OS-EXT-SRV-ATTR:hypervisor_hostname', 'flavor', 'id', '	security_groups', 'OS-SRV-USG:terminated_at', '	OS-EXT-AZ:availability_zone',
        'user_id', 'name', 'created', 'tenant_id', 'OS-DCF:diskConfig', 'os-extended-volumes:volumes_attached', 'accessIPv4', 'accessIPv6', 'progress', 'OS-EXT-STS:power_state',
        'config_drive', 'metadata', 'fault', 'last_update',
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
    
    
}
