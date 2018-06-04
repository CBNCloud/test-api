<?php

namespace App\Http\Controllers\Barang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Barang\Barangg;

class BarangController extends Controller
{
    /**
     * @var liberty_flavors
     */
    protected $model;
    
    /**
     * BarangController constructor.
     * @param Barangg $model
     */
    public function __construct(Barangg $model)
    {
        $this->model = $model;
    }
    
    /**
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function get_barang()
    {
        $data = $this->model->all();
        
        $res['success'] = 'success';
        $res['message'] = $data;
        
        return response($res);
    }
}
