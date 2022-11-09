<?php
namespace App\Models;
use CodeIgniter\Model;
class ProductModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $allowedFields = ['id_producto', 'producto','costo', 'precio1', 'precio2'];
    protected $returnType    = \App\Entities\Product::class;
    function search($param){
        $builder = $this->getBuilder();
        $results = $builder
                        ->select('id_producto, producto, precio1, grupo, costo')
                        ->like('producto', $param)
                        ->get()
                        ->getResult();   
        return  $results;
    }
    public function getBuilder(){
        return $this->db->table($this->table);
    }
}