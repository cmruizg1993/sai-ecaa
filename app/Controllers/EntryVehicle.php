<?php
namespace App\Controllers;

use App\Entities\EntryDetail;
use App\Entities\EntryImage;
use App\Entities\EntryWorkOrder;
use App\Models\ClientModel;
use App\Models\EntryDetailModel;
use App\Models\EntryImageModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EntryVehicleModel;
use App\Models\EntryWorkOrderModel;
use App\Models\VehicleDetailModel;
use App\Models\VehicleModel;
use App\Models\WorkOrderModel;
use DateTime;

class EntryVehicle extends ResourceController
{
    use ResponseTrait;
    public function index(){
        helper('jwt');
        $model = new EntryVehicleModel();
        $vehicleModel = new VehicleModel();
        $response['entries'] = [];
        $state_code = 'I';
        $company_id = getClaim($this->request, 'company_id');
        
        $entries = $model->where('codigo_estado', $state_code)->findAll();
        
        if($entries == null) return $this->respond($response);
        foreach($entries as $entry){
            $vehicle = $vehicleModel->find($entry->vehicle_id);
            $entry->vehicle = $vehicle;
        }
        $response['entries'] = $entries;
        return $this->respond($response);
    }
    public function show($id = null){
        $response['success'] = false;
        $model = new EntryVehicleModel();
        $entry = $model->find($id);
        $response['success'] = $entry != null ;
        if(!$response['success']) return $this->respond($response);;
        /* SE OBTIENEN LOS DETALLES DEL INGRESO */
        $detailsModel = new EntryDetailModel();
        $details = $detailsModel->where('id_ingreso_vehiculo', $id)->findAll();
        $entry_details = [];
        foreach($details as $detail){
            $vehicleDetailModel = new VehicleDetailModel();
            $entry_detail = $vehicleDetailModel->find($detail->detail_id);
            array_push($entry_details, $entry_detail);
        }
        $entry->details = $entry_details;

        /* SE OBTIENEN LAS FOTOS DEL VEHICULO */
        $imageModel = new EntryImageModel();
        $photos = $imageModel->where('idVehiculo', $id)->findAll();
        $entry->photos = $photos;
        /* SE OBTIENEN LOS DATOS DEL VEHICULO */
        $vehicleModel = new VehicleModel();
        $vehicle = $vehicleModel->find($entry->vehicle_id);
        $entry->vehicle = $vehicle;
        /* SE OBTIENEN LOS DATOS DEL CLIENTE */
        $clientModel = new ClientModel();
        $client = $clientModel->find($vehicle->client_id);
        $entry->client = $client;


        /* SE OBTIENEN LAS ORDENES DEL INGRESO */
        $ordersModel = new EntryWorkOrderModel();
        $orders = $ordersModel->where('id_ingreso', $id)->findAll();
        $entry_orders = [];
        $orderModel = new WorkOrderModel();
        foreach($orders as $o){            
            $order = $orderModel->find($o->order_id);
            array_push($entry_orders, $order);
        }
        $entry->orders = $entry_orders;
        $response['entry'] = $entry;
        return $this->respond($response);
    }
    // busca vehiculos por cliente o por placa
    public function create()
    {
        helper('jwt');        
        $model = new EntryVehicleModel();        
        $userData = getUserFromRequest($this->request);
        $response['success'] = false;
        if ($userData == null) return $this->respond($response);
        $json = json_encode($this->request->getJSON());
        $data = json_decode($json, true);
        
        $user_id = $userData->user_id;
        $state_code = 'I';
        $exist = $model->where('id_vehiculo', $data['vehicle_id'])->where('codigo_estado', $state_code)->first();
        /* VERIFICANDO QUE EL VEHICULO NO ESTE INGRESADO */
        $response['old'] = $exist;
        if ($exist != null) {
            $response['message'] = 'El vehículo ya está ingresado!';
            return $this->respond($response);
        }
        /* CREANDO INGRESO DEL VEHICULO */
        $entry = new \App\Entities\EntryVehicle();
        $entry->user_id = $user_id;
        $entry->vehicle_id = $data['vehicle_id'];
        $entry->state_code = $state_code;
        $entry->observations = isset($data['observations']) ? $data['observations']: null;        
        $insert_id = $model->add_entry($entry);

        /* RECUPERANDO E INSERTANDO LOS DETALLES DEL VEHICULO INGRESADO */
        $details = $data['details'];
        if($details ==  null){
            $response['message'] = 'Debe agregar los detalles del auto!';
            return $this->respond($response);
        }else{
            $detailModel = new VehicleDetailModel();
            foreach($details as $detail){
                if($detailModel->find($detail['id']) == null){
                    return $this->respond($response);
                }
            }
            $entryDetailModel = new EntryDetailModel();
            foreach($details as $detail){
                $d = new EntryDetail();
                $d->entry_id = $insert_id;
                $d->detail_id = $detail['id'];
                $entryDetailModel->save($d);
            }
        }   
        
        /* RECUPERANDO E INSERTANDO LAS ORDENES DE TRABAJO DEL VEHICULO INGRESADO */
        $orders = $data['orders'];
        if($orders != null){
            $entryOrderModel = new EntryWorkOrderModel();
            foreach($orders as $order){
                $o = new EntryWorkOrder();
                $o->entry_id = $insert_id;
                $o->order_id = $order;
                $entryOrderModel->save($o);
            }
        }
        
        /* RECUPERANDO E INSERTANDO LAS FOTOGRAFIAS VEHICULO INGRESADO */
        $photos = isset($data['photos']) ? $data['photos']: null;
        if($photos!=null){
            $imageModel = new EntryImageModel();
            foreach($photos as $photo){
                $img = new EntryImage();
                $img->base64 = $photo;
                $img->vehicle_id = $insert_id;
                $imageModel->save($img);
            }
        }
        
        $response['success'] = true;
        return $this->respond($response);        
    }
}
