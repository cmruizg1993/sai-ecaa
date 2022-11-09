<?php
namespace App\Models;
use CodeIgniter\Model;
class EntryWorkOrderModel extends Model
{
    protected $table = 'ingreso_orden_trabajo_vehiculo';
    //protected $primaryKey = 'id';
    protected $allowedFields = [
    'id_ingreso',
    'id_orden',
    ];
    protected $returnType    = \App\Entities\EntryWorkOrder::class;

}