<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Measurement extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    
    protected $attributes = [
        'MED_CODIGO' => null,
        'CIC_CODIGO'  => null,
        'MED_FECHA_HORA' => null,
        'MED_TEMP_AMBIENTAL' => null,
        'MED_HUM_RELATIVA' => null,
        'MED_HUM_SUELO' => null,
        'MED_OBSERVACIONES' => null
    ];
    protected $datamap = [
        'id' => 'MED_CODIGO',
        'cycle_id'  => 'CIC_CODIGO',
        'date_time' => 'MED_FECHA_HORA',
        'temperature' => 'MED_TEMP_AMBIENTAL',
        'relative_humidity' => 'MED_HUM_RELATIVA',
        'soil_moisture' => 'MED_HUM_SUELO',
        'observations' => 'MED_OBSERVACIONES'
    ];
}