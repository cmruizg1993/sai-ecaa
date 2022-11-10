<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class GrenHouse extends Entity
{    
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    protected $attributes = [
        'INV_CODIGO'=>null,
        'INV_DESCRIPCION'=>null,
        'INV_ESTADO'=>null,
        'INV_OBSERVACIONES'=>null,
    ];
    protected $datamap = [
        'id'=>'INV_CODIGO',
        'description'=>'INV_DESCRIPCION',
        'state'=>'INV_ESTADO',
        'observations'=>'INV_OBSERVACIONES',
    ];
}
