<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CropModel;

class Crop extends BaseController
{
    public function create()
    {
        $response['success'] = false;
        $model = new CropModel();
        $data = $this->request->getJSON(true);
        $crop =  new \App\Entities\Crop();
        $crop->fill($data);
        $model->save($crop);
        $response['success'] = true;
        return $this->respond($response);
    }    
    public function index()
    {        
        $model = new CropModel();
        $data = $model->findAll();
        return $this->respond($data);
    }
    public function update($id = null)
    {
        $response['success'] = false;
        $model = new CropModel();
        $data = $this->request->getJSON(true);
        $entity =  new \App\Entities\Crop();
        $entity->fill($data);
        $model->update($id, $entity);
        $response['success'] = true;
        return $this->respond($response);
    }
    public function delete($id = null)
    {
        $model = new CropModel();
        $response['success'] = false;
        $model->delete($id, true);
        $response['success'] = true;
        return $this->respond($response);
    }
    public function show($id = null)
    {
        $model = new CropModel();
        $result = $model->find($id);        
        $response['maxT'] = $result->max_temp;
        $response['minT'] = $result->min_temp;
        $response['maxHS'] = $result->max_hs;
        $response['minHS'] = $result->max_hs;
        //$response = [$result->max_temp, $result->min_temp, $result->max_hs, $result->max_hs];
        //return $this->respond(join(",",$response));
        return $this->respond($response);
    }
}
