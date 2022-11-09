<?php
namespace App\Models;
use CodeIgniter\Model;
class ProviderModel extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedores';
    protected $allowedFields = [];
    protected $returnType    = \App\Entities\Provider::class;
    function search($param){
        $builder = $this->getBuilder();
        $results = $builder
                        ->select('id_proveedor, nombre, nombre_comercial, ruc')
                        ->like('nombre', $param)
                        ->orLike('nombre_comercial', $param)
                        ->orLike('ruc', $param)
                        ->get()
                        ->getResult();   
        return  $results;
    }
    public function getBuilder(){
        return $this->db->table($this->table);
    }
}