<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EntryImage extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    
    protected $attributes = [
        'id' => null,
        'vehicle_id'  => null,
        'url' => null,
        'base64' => null
    ];
    protected $datamap = [
        'id' => 'id',
        'vehicle_id'  => 'idVehiculo',
        'url' => 'url',
        'base64' => 'base64'
    ];
}