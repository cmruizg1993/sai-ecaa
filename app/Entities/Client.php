<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Client extends Entity
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
        'lastName'          => null,
        'address'           => null,
        'documentNumber'    => null,
        'phone'             => null,
        'cellphone'         => null,
        'email'             => null,
        'companyId'         => null,
        'state'             => 'Activo'
    ];
    protected $datamap = [
        'id'                => 'id_cliente',
        'name'              => 'nombre',
        'lastName'          => 'apellido',
        'address'           => 'direccion',
        'documentNumber'    => 'cedula',
        'phone'             => 'telefono',
        'cellphone'         => 'movil',
        'email'             => 'email',
        'state'             => 'estado',
        'companyId'         => 'id_empresa'
    ];
}