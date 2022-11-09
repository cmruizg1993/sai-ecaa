<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Provider extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    protected $attributes = [
        'id'                => null,
        'name'              => null,
        'tradename'         => null,
        'ruc'               => null,
    ];
    protected $datamap = [
    'id'                => 'id_proveedor',
    'name'              => 'nombre',
    'tradename'         => 'nombre_comercial',
    'ruc'               => 'ruc',
    ];
}