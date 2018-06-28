<?php

namespace App\Model\Icehouse;

use Illuminate\Database\Eloquent\Model;

class Icehouse_images extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'images_id', 'id', 'links', 'name', 'last_update'
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
