<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\VehicleDetailModel;

class VehicleDetail extends ResourceController
{
    use ResponseTrait;
    // busca vehiculos por cliente o por placa
    public function index()
    {
        helper('jwt');        
        $model = new VehicleDetailModel();        
        $userData = getUserFromRequest($this->request);
        $response['success'] = false;
        if ($userData == null) return $this->respond($response);
        $json = json_encode($this->request->getJSON());
        $data = json_decode($json, true);
        $companyId = $userData->company_id;
        $data['details'] = $model->where('empresa', $companyId)->findAll();
        return $this->respond($data);        
    }

}
