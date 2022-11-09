<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Vehicle extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    protected $attributes = [
        'id'         => null,
        'client_id'  => null,
        'model'      => null,
        'color'      => null,
        'chassis'    => null,
        'license_plate' => null,
        'motor'         => null,
        'motor_model'   => null,
        'mileage'       => null
    ];
    protected $datamap = [
        'client_id'  => 'idCliente',
        'model'      => 'modelo',
        'color'   => 'color',
        'chassis' => 'chasis',
        'license_plate' => 'placa',
        'motor' => 'motor',
        'motor_model' => 'modeloMotor',
        'mileage' => 'kilometraje'
    ];
}