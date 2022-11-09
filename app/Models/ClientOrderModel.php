<?php
namespace App\Models;
use CodeIgniter\Model;
class ClientOrderModel extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'pedido';
    protected $allowedFields = ['pedido','fecha_pedido','estado','total','sub_total','fecha_anulacion','id_cliente','id_empresa','tipo_documento','id_usuario'];
    protected $returnType    = \App\Entities\ClientOrder::class;
    function add_client_order($entry){
        $this->save($entry);
        $insert_id = $this->db->insertID();     
        return  $insert_id;
     }
     public function getBuilder(){
        return $this->db->table($this->table);
    }
}