<?php
namespace App\Models;
use CodeIgniter\Model;
class ClientModel extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    protected $allowedFields = ['id_cliente', 'nombre', 'apellido', 'direccion', 'cedula', 'email', 'telefono', 'movil', 'id_empresa'];
    protected $returnType    = \App\Entities\Client::class;
    function search($param){
        $builder = $this->getBuilder();
        $results = $builder
                        ->select('id_cliente, nombre, apellido, direccion, cedula, email, telefono')
                        ->like('nombre', $param)
                        ->orLike('apellido', $param)
                        ->orLike('cedula', $param)
                        ->get()
                        ->getResult();   
        return  $results;
    }
    public function getBuilder(){
        return $this->db->table($this->table);
    }
}