<?php

namespace App\Model\Icehouse;

use Illuminate\Database\Eloquent\Model;

class Icehouse_usages extends Model
{
    /**
     * @var string
     */
    protected $table = 'icehouse_usage';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usage_id', 'total_memory_mb_usage', 'total_vcpus_usage', 'start', 'tenant_id', 'stop', 'total_hours', 'total_local_gb_usage', 'last_update'
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
