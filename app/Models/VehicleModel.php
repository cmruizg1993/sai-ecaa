<?php
namespace App\Models;
use CodeIgniter\Model;
class VehicleModel extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
    'id',
    'idCliente',
    'modelo',
    'color',
    'chasis',
    'placa',
    'motor',
    'modeloMotor',
    'kilometraje',];
    protected $returnType    = \App\Entities\Vehicle::class;

    public function getVehiclesByClientOrPlaque($parameter)
    {
        $builder = $this->getBuilder();
        $builder->select('*');
        $builder->join('clientes', 'clientes.id_cliente = vehiculos.idCliente');
        $builder->where('clientes.cedula =', $parameter);
        $builder->orWhere('vehiculos.placa =', $parameter);
        $query = $builder->get();
        return $query->getResult();
    }
    public function getBuilder(){
        return $this->db->table($this->table);
    }
}