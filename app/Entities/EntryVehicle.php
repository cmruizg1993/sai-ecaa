<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EntryVehicle extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    protected $attributes = [
        'id'         => null,
        'date_time'       => null,
        'vehicle_id' => null,
        'user_id' => null,
        'state_code' => null,
        'observations'=> null
    ];
    protected $datamap = [
        'id'         => 'id',
        'date_time'       => 'fecha',
        'vehicle_id' => 'id_vehiculo',
        'user_id' => 'id_usuario',
        'state_code' => 'codigo_estado',
        'observations'=> 'observaciones',
    ];
}