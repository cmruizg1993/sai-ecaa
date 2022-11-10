<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CropCycleModel;

class CropCycle extends BaseController
{
    public function create()
    {
        $response['success'] = false;
        $model = new CropCycleModel();
        $data = $this->request->getJSON(true);
        $cropCycle =  new \App\Entities\CropCycle();
        $cropCycle->fill($data);
        $model->save($cropCycle);
        $response['success'] = true;
        return $this->respond($response);        
    }    
    public function index()
    {        
        $model = new CropCycleModel();
        $data = $model->findAll();
        return $this->respond($data);       
    }
    public function update($id = null)
    {
        $response['success'] = false;
        $model = new CropCycleModel();
        $data = $this->request->getJSON(true);
        $entity =  new \App\Entities\CropCycle();
        $entity->fill($data);
        $model->update($id, $entity);
        $response['success'] = true;
        return $this->respond($response);      
    }
    public function delete($id = null)
    {
        $model = new CropCycle();
        $response['success'] = false;
        $model->delete($id);
        $response['success'] = true;
        return $this->respond($response);
    }
}
