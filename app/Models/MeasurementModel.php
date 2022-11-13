<?php
namespace App\Models;
use CodeIgniter\Model;

class MeasurementModel extends Model
{
    protected $table = 't_mediciones';
    protected $primaryKey = 'MED_CODIGO';
    protected $allowedFields = [
        'MED_CODIGO',
        'CIC_CODIGO' ,
        'MED_TEMP_AMBIENTAL',
        'MED_HUM_RELATIVA',
        'MED_HUM_SUELO',
        'MED_OBSERVACIONES'
    ];
    protected $returnType    = \App\Entities\Measurement::class;
    
}