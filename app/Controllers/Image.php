<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class Image extends ResourceController
{
    use ResponseTrait;


    public function show($id = null, $entity = null){
        $model = null;
        if($entity == "category"){
            $model = new CategoryModel();
        }
        if($entity == "product"){
            $model = new ProductModel();
        }
        
        if($model == null) return null;

        $data['entity'] = $model->find($id);
        $image['data'] = null;
        if($data['entity'] != null){
            if($data['entity']['img'] == ''){
                return $this->respond($image);
            }
            $path = 'images/' . $data['entity']['img'];
            if(!file_exists($path)){
                return $this->respond($image);
            } 
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $image['data'] = $base64;
        }
        return $this->respond($image);
    }
}
