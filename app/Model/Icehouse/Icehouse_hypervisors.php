<?php

namespace App\Model\Icehouse;

use Illuminate\Database\Eloquent\Model;

class Icehouse_hypervisors extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hypervisors_id', 'status', 'service', 'vcpus_used', 'hypervisor_type', 'local_gb_used', 'vcpus', 'hypervisor_hostname', 'memory_mb_used', 'memory_mb', 'current_workload', 'state', 'host_ip',
        'cpu_info', 'running_vms', 'free_disk_gb', 'hypervisor_version', 'disk_available_least', 'local_gb', 'free_ram_mb', 'id', 'last_update'
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
