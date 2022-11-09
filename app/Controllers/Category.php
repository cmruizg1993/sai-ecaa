<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CategoryModel;

class Category extends ResourceController
{
    use ResponseTrait;

    // all categories
    public function index()
    {
        $model = new CategoryModel();
        $data['categories'] = $model->where('empresa', 47)->findAll();
        return $this->respond($data);
    }
    
}
