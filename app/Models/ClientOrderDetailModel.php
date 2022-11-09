<?php
namespace App\Models;
use CodeIgniter\Model;
class ClientOrderDetailModel extends Model
{
    protected $table = 'detalle_pedido';
    protected $primaryKey = 'id_detalle_pedido';
    protected $allowedFields = ['id_detalle_pedido','pedido','estado','cantidad','v_unitario','v_total','id_servicio'];
    protected $returnType    = \App\Entities\ClientOrderDetail::class;
}