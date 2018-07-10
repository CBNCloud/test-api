<?php

namespace App\Model\Icehouse;

use Illuminate\Database\Eloquent\Model;

class Icehouse_usage_servers extends Model
{
    /**
     * @var string
     */
    protected $table = 'icehouse_usage_server';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'server_usage_id', 'usage_id', 'instance_id', 'uptime', 'started_at', 'ended_at', 'memory_mb', 'tenant_id', 'last_update', 'state', 'hours',
        'vcpus', 'flavor', 'local_gb', 'name', 'last_update'
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
