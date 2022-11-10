<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GreenHouseModel;

class GreenHouse extends BaseController
{
    public function create()
    {
        $response['success'] = false;
        $model = new GreenHouseModel();
        $data = $this->request->getJSON(true);
        $greenHouse =  new \App\Entities\GrenHouse();
        $greenHouse->fill($data);
        $model->save($greenHouse);
        $response['success'] = true;
        return $this->respond($response);
    }    
    public function index()
    {        
        $model = new GreenHouseModel();
        $data = $model->findAll();
        return $this->respond($data);        
    }
    public function update($id = null)
    {
        $response['success'] = false;
        $model = new GreenHouseModel();
        $data = $this->request->getJSON(true);
        $entity =  new \App\Entities\GrenHouse();
        $entity->fill($data);
        $model->update($id, $entity);
        $response['success'] = true;
        return $this->respond($response);      
    }
    public function delete($id = null)
    {
        $model = new GreenHouseModel();
        $response['success'] = false;
        $model->delete($id);
        $response['success'] = true;
        return $this->respond($response);
    }
}
