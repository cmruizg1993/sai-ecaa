<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class WorkOrder extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    
    protected $attributes = [
        'id' => null,
        'company_id'  => null,
        'name' => null,
        'description' => null
    ];
    protected $datamap = [
        'id' => 'id',
        'company_id'  => 'id_empresa',
        'name' => 'nombre',
        'description' => 'descripcion'
    ];
}