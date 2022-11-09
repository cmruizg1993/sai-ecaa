<?php
namespace App\Models;
use CodeIgniter\Model;
class EntryVehicleModel extends Model
{
    protected $table = 'ingreso_vehiculos';
    //protected $primaryKey = 'id';
    protected $allowedFields = [
    'fecha',
    'id_vehiculo',
    'id_usuario',
    'codigo_estado',
    'observaciones'
    ];
    protected $returnType    = \App\Entities\EntryVehicle::class;
    function add_entry($entry){
        $this->save($entry);
        $insert_id = $this->db->insertID();     
        return  $insert_id;
     }
     public function getBuilder(){
        return $this->db->table($this->table);
    }
}   