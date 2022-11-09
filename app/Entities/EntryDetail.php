<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class EntryDetail extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    
    protected $attributes = [
        'entry_id' => null,
        'detail_id'  => null
    ];
    protected $datamap = [
        'entry_id' => 'id_ingreso_vehiculo',
        'detail_id'  => 'id_detalle_vehiculo'
    ];
}