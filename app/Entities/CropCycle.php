<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class CropCycle extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
        'CIC_ACTIVO' => 'boolean'
    ];
    
    protected $attributes = [
        'CIC_CODIGO'=>null,
        'INV_CODIGO'=>null,
        'CUL_CODIGO'=>null,
        'CIC_FECHA_INICIO'=>null,
        'CIC_FECHA_FIN'=>null,
        'CIC_OBSERVACIONES'=>null,
        'CIC_ACTIVO'=>null,
    ];
    protected $datamap = [
        'id'=>'CIC_CODIGO',
        'greenhouse_id'=>'INV_CODIGO',
        'crop_id'=>'CUL_CODIGO',
        'init_date'=>'CIC_FECHA_INICIO',
        'end_date'=>'CIC_FECHA_FIN',
        'observations'=>'CIC_OBSERVACIONES',
        'active'=>'CIC_ACTIVO',
    ];
}