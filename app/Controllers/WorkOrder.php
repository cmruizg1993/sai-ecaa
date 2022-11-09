<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\VehicleDetailModel;
use App\Models\WorkOrderModel;

class WorkOrder extends ResourceController
{
    use ResponseTrait;
    // busca vehiculos por cliente o por placa
    public function index()
    {
        helper('jwt');        
        $model = new WorkOrderModel();        
        $userData = getUserFromRequest($this->request);
        $response['success'] = false;
        if ($userData == null) return $this->respond($response);
        $json = json_encode($this->request->getJSON());
        $data = json_decode($json, true);
        $companyId = $userData->company_id;
        $data['orders'] = $model->where('id_empresa', $companyId)->findAll();
        return $this->respond($data);        
    }

}
