<?php

namespace App\Models;

use CodeIgniter\Model;
/**
 * Class GreenHouseModel
 * @method \App\Entities\GrenHouse find($id = null)
 * @method \App\Entities\GrenHouse [] findAll()
 */
class GreenHouseModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 't_invernadero';
    protected $primaryKey       = 'INV_CODIGO';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = \App\Entities\GrenHouse::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['INV_CODIGO','INV_DESCRIPCION','INV_ESTADO','INV_OBSERVACIONES'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
