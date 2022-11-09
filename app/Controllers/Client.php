<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ClientModel;

class Client extends ResourceController
{
    use ResponseTrait;

    public function show($ci = null)
    {
        $model = new ClientModel();
        $data['client'] = $model->where('cedula', $ci)->first();;
        return $this->respond($data);
    }
    public function create()
    {
        helper('jwt');        
        $model = new ClientModel();
        
        $userData = getUserFromRequest($this->request);
        $response['success'] = false;
        if ($userData == null) return $this->respond($response);
        $json = json_encode($this->request->getJSON());
        $data = json_decode($json, true);
        $client = new \App\Entities\Client();
        $client->fill($data);
        $client->state = 'Activo';
        $client->companyId = $userData->company_id;
        $oldClient = $model->where('cedula', $client->documentNumber)->first();
        $response['success'] = false;
        $response['client'] = $client;
        if($oldClient){
            $model->update($oldClient->id, $client);
            $response['success'] = true;
            return $this->respond($response);
        }     
        $model->save($client);   
        $response['success'] = true;
        return $this->respond($response);
    }
    public function search()
    {        
        $input = $this->request->getJSON();
        $model = new ClientModel();
        $data['clients'] = $model->search($input->searchParam);
        return $this->respond($data);
    }
}
