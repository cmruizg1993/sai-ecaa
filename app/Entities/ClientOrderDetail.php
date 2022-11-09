<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ClientOrderDetail extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    
    protected $attributes = [
        'id' => null,
        'client_order_id' => null,
        'state' => null,
        'amount' => null,
        'unit_value' => null,
        'total' => null,
        'service_id' => null
    ];
    protected $datamap = [
        'id' => 'id_detalle_pedido',
        'client_order_id' => 'pedido',
        'state' => 'estado',
        'amount' => 'cantidad',
        'unit_value' => 'v_unitario',
        'total' => 'v_total',
        'service_id' => 'id_servicio'
    ];
}