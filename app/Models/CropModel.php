<?php

namespace App\Models;

use CodeIgniter\Model;
/*
* @method \App\Entities\Crop find($id = null)
 * @method \App\Entities\Crop [] findAll()
*/
class CropModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 't_cultivos';
    protected $primaryKey       = 'CUL_CODIGO';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = \App\Entities\Crop::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['CUL_CODIGO','CUL_DESCRIPCION','CUL_KC_INI','CUL_KC_MED','CUL_KC_FIN','CUL_TA_MAX','CUL_TA_MIN','CUL_HR_MAX','CUL_HR_MIN','CUL_HS_MAX','CUL_HS_MIN',];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

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
