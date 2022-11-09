<?php
namespace App\Models;
use CodeIgniter\Model;
class VehicleDetailModel extends Model
{
    protected $table = 'detalles_vehiculo';
    protected $primaryKey = 'id';
    protected $allowedFields = [
    'id',
    'detalle',
    'empresa',];
    protected $returnType    = \App\Entities\VehicleDetail::class;

}