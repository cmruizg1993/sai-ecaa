<?php
namespace App\Models;
use CodeIgniter\Model;
class EntryImageModel extends Model
{
    protected $table = 'imgvehiculos';
    //protected $primaryKey = 'id';
    protected $allowedFields = [
    'id',
    'idVehiculo',
    'url',
    'base64'
    ];
    protected $returnType    = \App\Entities\EntryImage::class;

}