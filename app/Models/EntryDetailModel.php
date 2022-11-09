<?php
namespace App\Models;
use CodeIgniter\Model;
class EntryDetailModel extends Model
{
    protected $table = 'detalles_ingreso_vehiculo';
    //protected $primaryKey = 'id';
    protected $allowedFields = [
    'id_ingreso_vehiculo',
    'id_detalle_vehiculo',
    ];
    protected $returnType    = \App\Entities\EntryDetail::class;

}