<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ClientOrder extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    
    protected $attributes = [
        'id' => null,
        'date' => null,
        'state' => null,
        'total' => null,
        'sub_total' => null,
        'client_id' => null,
        'company_id' => null,
        'document_type' => null,
        'user_id' => null
    ];
    protected $datamap = [
        'id' => 'pedido',
        'date' => 'fecha_pedido',
        'state' => 'estado',
        'total' => 'total',
        'sub_total' => 'sub_total',
        'cancellation_date' => 'fecha_anulacion',
        'client_id' => 'id_cliente',
        'company_id' => 'id_empresa',
        'document_type' => 'tipo_documento',
        'user_id' => 'id_usuario'
    ];
}