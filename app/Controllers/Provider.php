<?php
namespace App\Controllers;

use App\Models\ProviderModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Provider extends ResourceController
{
    use ResponseTrait;

    public function search()
    {        
        $input = $this->request->getJSON();
        $model = new ProviderModel();
        $data['providers'] = $model->search($input->searchParam);
        //$data['product'] = $model->find();
        return $this->respond($data);
    }
}
