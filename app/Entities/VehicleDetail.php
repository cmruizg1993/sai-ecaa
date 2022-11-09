<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class VehicleDetail extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    protected $attributes = [
        'id'         => null,
        'name'       => null,
        'company_id' => null
    ];
    protected $datamap = [
        'id'  => 'id',
        'name'      => 'detalle',
        'company_id'   => 'empresa',
    ];
}