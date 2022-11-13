<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MeasurementModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use DateTime;

class Measurement extends BaseController
{
    use ResponseTrait;
    // busca vehiculos por cliente o por placa
    public function report($init_date, $end_date)
    {
        helper('jwt');
        //return $this->respond([$init_date, $end_date]);
        $model = new MeasurementModel();
        //$userData = getUserFromRequest($this->request);
        $response['success'] = false;
        //if ($userData == null) return $this->respond($response);
        //$json = json_encode($this->request->getJSON());
        //$data = json_decode($json, true);
        //$companyId = $userData->company_id;
        $init_date = new DateTime(explode('T', $init_date)[0]);
        $end_date = new DateTime(explode('T', $end_date)[0].'T23:59');
        $data = $model
            ->where('MED_FECHA_HORA>=', ($init_date)->format('Y-m-d H:i'))
            ->where('MED_FECHA_HORA<=', ($end_date)->format('Y-m-d H:i'))
            ->findAll();
        return $this->respond($data);       
    }
    public function create()
    {
        $response['success'] = false;
        $model = new MeasurementModel();
        $data = json_encode($this->request->getJSON());
        $json = json_decode($data, true);
        $measurement = new \App\Entities\Measurement();
        $measurement->fill($json);
        $model->save($measurement);
        $response['success'] = true;
        helper('firebase');
        setData('', $measurement);
        return $this->respond($response);
    }
    public function create2()
    {
        $response['success'] = false;
        $data = json_encode($this->request->getJSON());
        $json = json_decode($data, true);
        $response['success'] = true;
        $values = explode(",", $json["data"]);
        $measurement = new \App\Entities\Measurement();
        //$measurement->fill($json);
        $measurement->temperature = (int)$values[0];
        $measurement->relative_humidity = (int)$values[1];
        $measurement->soil_moisture = (int)$values[2];
        $measurement->cycle_id = 4;
        $model = new MeasurementModel();
        $model->save($measurement);

        $response['data'] = $measurement;
        helper('firebase');
        $data =[];
        $data['monitoreo'] = [];
        $data['monitoreo']['temperatura'] = [];
        $data['monitoreo']['temperatura']['nivel1'] = $measurement->temperature;
        $data['monitoreo']['humedadr'] = [];
        $data['monitoreo']['humedadr']['nivel1'] = $measurement->relative_humidity;
        $data['monitoreo']['humedads'] = [];
        $data['monitoreo']['humedads']['nivel1'] = $measurement->soil_moisture;
        setData('', $data);
        $response['data'] = $data;
        return $this->respond($response);
    }
}
