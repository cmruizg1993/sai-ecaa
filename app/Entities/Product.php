<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Product extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    protected $attributes = [
        'id' => null, 'name' => null,'cost' => null, 'price' => null, 'iva' => null
    ];
    protected $datamap = [
        'id' => 'id_producto', 'name' => 'producto','cost' => 'costo', 'price' => 'precio1', 'iva' => 'iva'
    ];
}