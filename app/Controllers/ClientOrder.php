<?php
namespace App\Controllers;

use App\Entities\ClientOrderDetail;
use App\Entities\EntryDetail;
use App\Entities\EntryImage;
use App\Entities\EntryWorkOrder;
use App\Models\ClientModel;
use App\Models\ClientOrderDetailModel;
use App\Models\ClientOrderModel;
use App\Models\EntryDetailModel;
use App\Models\EntryImageModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EntryVehicleModel;
use App\Models\EntryWorkOrderModel;
use App\Models\ProductModel;
use App\Models\VehicleDetailModel;
use App\Models\VehicleModel;
use App\Models\WorkOrderModel;
use DateTime;

class ClientOrder extends ResourceController
{
    use ResponseTrait;
    private $iva = 1.12;
    /*
    public function index(){
        helper('jwt');
        $model = new EntryVehicleModel();
        $vehicleModel = new VehicleModel();
        $response['entries'] = [];
        $state_code = 'I';
        $company_id = getClaim($this->request, 'company_id');
        $entries = $model->where('codigo_estado', $state_code)->findAll();
        if($entries == null) return $response;
        foreach($entries as $entry){
            $vehicle = $vehicleModel->find($entry->vehicle_id);
            $entry->vehicle = $vehicle;
        }
        $response['entries'] = $entries;
        return $this->respond($response);
    }
    */

    /*
    public function show($id = null){
        $response['success'] = false;
        $model = new EntryVehicleModel();
        $entry = $model->find($id);
        $response['success'] = $entry != null ;
        if(!$response['success']) return $this->respond($response);;
        /* SE OBTIENEN LOS DETALLES DEL INGRESO 
        $detailsModel = new EntryDetailModel();
        $details = $detailsModel->where('id_ingreso_vehiculo', $id)->findAll();
        $entry_details = [];
        foreach($details as $detail){
            $vehicleDetailModel = new VehicleDetailModel();
            $entry_detail = $vehicleDetailModel->find($detail->detail_id);
            array_push($entry_details, $entry_detail);
        }
        $entry->details = $entry_details;

        /* SE OBTIENEN LAS FOTOS DEL VEHICULO 
        $imageModel = new EntryImageModel();
        $photos = $imageModel->where('idVehiculo', $id)->findAll();
        $entry->photos = $photos;
        /* SE OBTIENEN LOS DATOS DEL VEHICULO 
        $vehicleModel = new VehicleModel();
        $vehicle = $vehicleModel->find($entry->vehicle_id);
        $entry->vehicle = $vehicle;
        /* SE OBTIENEN LOS DATOS DEL CLIENTE 
        $clientModel = new ClientModel();
        $client = $clientModel->find($vehicle->client_id);
        $entry->client = $client;


        /* SE OBTIENEN LAS ORDENES DEL INGRESO 
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
    */


    public function create()
    {
        helper('jwt');        
        $model = new ClientOrderModel();
        
        $userData = getUserFromRequest($this->request);
        $response['success'] = false;
        if ($userData == null) return $this->respond($response);
        $jsonInput = json_encode($this->request->getJSON());
        $dataInput = json_decode($jsonInput, true);        
        $user_id = $userData->user_id;

        $state = 'ACTIVO';
        
        /* CREANDO INGRESO DEL PEDIDO */
        $client_order = new \App\Entities\ClientOrder();
        $client_order->user_id = $user_id;
        $client_order->state = $state;
        $client_order->date = (new DateTime())->format('Y-m-d');
        //$client_order->observations = isset($data['observations']) ? $data['observations']: null;        
        $client_order->total = 0;
        $client_order->sub_total = 0;
        $client_order->company_id = $userData->company_id;;
        $client_order->client_id = $dataInput['client_id'];

        $insert_id = $model->add_client_order($client_order);
        $client_order->id = $insert_id;
        /* RECUPERANDO E INSERTANDO LOS DETALLES DEL PEDIDO INGRESADO */
        $items = $dataInput['items'];
        if($items ==  null){
            $response['message'] = 'Debe agregar los detalles del auto!';
            return $this->respond($response);
        }else{
            $productModel = new ProductModel();
            $detailModel = new ClientOrderDetailModel();
            $details = [];   
            foreach($items as $item){
                $product = $productModel->find($item['product_id']);
                $amount = $item['amount'];
                if($product == null){
                    return $this->respond($response);
                }
                $client_order->sub_total += $product->price * $amount;
                if($product->iva == "Si"){
                    $client_order->sub_total += $product->price * $amount;
                }else{
                    $client_order->total += $product->price * $amount*$this->iva;
                }
                $detail = new ClientOrderDetail();
                $detail->client_order_id = $client_order->id;
                $detail->state = 'Activo';
                $detail->amount= $amount;
                $detail->unit_value = $product->price;
                $detail->total = $product->price*$amount;
                $detail->sevice_id = $product->id;
                $detailModel->insert($detail);
                array_push($details, $detail);
                //return $this->respond(["product"=>$product]);
            }
            $model->save($client_order);
        }
        $client_order->details = $details;    
        $response['success'] = true;
        $response['order'] =$client_order;
        return $this->respond($response);        
    }
}
