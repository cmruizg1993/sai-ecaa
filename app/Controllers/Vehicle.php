<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\VehicleModel;
use App\Models\ClientModel;

class Vehicle extends ResourceController
{
    use ResponseTrait;
    // busca vehiculos por cliente o por placa
    public function search($parameter)
    {
        $clientModel = new ClientModel();
        $model = new VehicleModel();
        //$data['vehicles'] = $model->getVehiclesByClientOrPlaque($parameter);
        $client = null;
        $vehicles = [];
        $vehicle =  $model->where('placa', $parameter)->first();
        //return $this->respond(['vehicle'=>$vehicle]);
        if($vehicle!=null){
            array_push($vehicles, $vehicle);
            $client = $clientModel->find($vehicle->client_id);
            $data['client'] = $client;
            $data['vehicles'] = $vehicles;
            return $this->respond($data);
        }
        $client = $clientModel->where('cedula', $parameter)->first();
        if($client!=null){
            $vehicles = $model->where('idCliente', $client->id)->findAll();
            $data['client'] = $client;
            $data['vehicles'] = $vehicles;
            return $this->respond($data);
        }
        return $this->respond(null);
    }
    public function show($id = null)
    {
        
        $model = new VehicleModel();
        $data['vehicle'] = $model->where('placa', $id)->first();;
        return $this->respond($data);
    }
    public function create()
    {
        $response['success'] = false;
        $model = new VehicleModel();
        $data = json_encode($this->request->getJSON());
        $json = json_decode($data, true);
        $vehicle = new \App\Entities\Vehicle();
        //$vehicle->modelo = "test modelo";
        $vehicle->fill($json);
        $model->save($vehicle);
        $response['success'] = true;
        return $this->respond($response);
    }
}
