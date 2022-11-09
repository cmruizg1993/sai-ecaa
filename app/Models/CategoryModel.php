<?php
namespace App\Models;
use CodeIgniter\Model;
class CategoryModel extends Model
{
    protected $table = 'centro_costo';
    protected $primaryKey = 'id_centro_costo';
    protected $allowedFields = ['id_centro_costo', 'descripcion', 'empresa', 'img'];
}