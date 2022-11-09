<?php
namespace App\Models;
use CodeIgniter\Model;
class WorkOrderModel extends Model
{
    protected $table = 'tipo_orden_trabajo';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'id_empresa',
        'nombre',
        'descripcion'
    ];
    protected $returnType    = \App\Entities\WorkOrder::class;

}