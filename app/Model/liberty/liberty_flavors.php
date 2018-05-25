<?php

namespace App\Model\liberty;

use Illuminate\Database\Eloquent\Model;

class liberty_flavors extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'flavors_id', 'name', 'links', 'ram', 'OS-FLV-DISABLED:disabled','vcpus','swap','os-flavor-access:is_public','rxtx_factor','OS-FLV-EXT-DATA:ephemeral','disk','id','last_update'
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
