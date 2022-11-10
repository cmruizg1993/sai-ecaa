<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Crop extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [
        'options'        => 'array',
        'options_object' => 'json',
        'options_array'  => 'json-array',
    ];
    
    protected $attributes = [
        'CUL_CODIGO'=>null,
        'CUL_DESCRIPCION'=>null,
        'CUL_KC_INI'=>null,
        'CUL_KC_MED'=>null,
        'CUL_KC_FIN'=>null,
        'CUL_TA_MAX'=>null,
        'CUL_TA_MIN'=>null,
        'CUL_HR_MAX'=>null,
        'CUL_HR_MIN'=>null,
        'CUL_HS_MAX'=>null,
        'CUL_HS_MIN'=>null,

    ];
    protected $datamap = [
        'id'=>'CUL_CODIGO',
        'description'=>'CUL_DESCRIPCION',
        'kc_init'=>'CUL_KC_INI',
        'kc_med'=>'CUL_KC_MED',
        'kc_final'=>'CUL_KC_FIN',
        'max_temp'=>'CUL_TA_MAX',
        'min_temp'=>'CUL_TA_MIN',
        'max_hr'=>'CUL_HR_MAX',
        'min_hr'=>'CUL_HR_MIN',
        'max_hs'=>'CUL_HS_MAX',
        'min_hs'=>'CUL_HS_MIN',
    ];
}