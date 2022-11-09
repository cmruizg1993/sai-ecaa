<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class Product extends ResourceController
{
    use ResponseTrait;

    // all categories
    public function index($categoryId = null)
    {
        if($categoryId == null) return $this->respond($categoryId);
        $model = new ProductModel();
        $data['products'] = $model->where('id_empresa', 47)->where('grupo', $categoryId)->findAll();
        return $this->respond($data);
    }
    public function show($id = null)
    {
        if($id == null) return $this->respond($id);
        $model = new ProductModel();
        $data['product'] = $model->find($id);
        return $this->respond($data);
    }
    public function search()
    {        
        $input = $this->request->getJSON();
        $model = new ProductModel();
        $data['products'] = $model->search($input->searchParam);
        //$data['product'] = $model->find();
        return $this->respond($data);
    }
}
