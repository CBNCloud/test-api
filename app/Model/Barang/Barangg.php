<?php

namespace App\Model\Barang;

use Illuminate\Database\Eloquent\Model;

class Barangg extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal', 'type', 'nama', 'jam','keterangan', 'status','created_at','updated_at'
    ];
    
    /**
     * @var string table cmp_member
     */
    protected $table = 'barang';
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];
    
    /**
     * @var bool timestamps
     */
    public $timestamps = false;
    
    
}
