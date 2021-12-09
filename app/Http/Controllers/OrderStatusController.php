<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class OrderStatusController extends Controller
{
    //
    function changeStatus(Request $request){

        $id_order = $request->id_order;
        $status = $request->status;

        $order = History::find($id_order);
        $order->job_status = $status;
        $order->save();
        $response = array("msj" => "Actualizado correctamente");
        
        return $response;

    }

    function changePayStatus(Request $request){

        $id_order = $request->id_order;
        $status = $request->pay_status;

        $order = History::find($id_order);
        $order->pay_status = $status;
        $order->save();
        $response = array("msj" => "Actualizado correctamente");
        
        return $response;

    }
}
