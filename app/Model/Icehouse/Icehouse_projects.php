<?php

namespace App\Model\Icehouse;

use Illuminate\Database\Eloquent\Model;

class Icehouse_projects extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projects_id', 'is_domain', 'description', 'links', 'enabled', 'id', 'parent_id', 'domain_id', 'name', 'last_update'
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
