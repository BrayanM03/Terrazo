<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use App\Models\History;


date_default_timezone_set("America/Matamoros");

class OrdersController extends Controller
{
    //

    function saveHeader(Request $request)
    {
        $customer_id = $request->customer_id;
        $date = $request->date;
        $re = $request->re;
        $sow = $request->sow;
        $store_number = $request->store_number;

        $request->session()->put('customer_id', $customer_id);
        $request->session()->put('date', $date);
        $request->session()->put('re', $re);
        $request->session()->put('sow', $sow);
        $request->session()->put('store_number', $store_number);
        
    }

    function register(Request $request)
    {
        $user_id = auth()->user()->id; 
        $customer_id =  $request->session()->get('customer_id');
        $date = $request->session()->get('date');
        $re = $request->session()->get('re');
        $sow = $request->session()->get('sow');
        $store_number =$request->session()->get('store_number');
        $sub_total = $request->sub_total;
        $contract = $request->contract;
        $grand_total = $request->grand_total;
        $job_status = "Pending";
        $pay_status = "Unpaid";

       

        $data = new History();

        $data = History::create([
            'customer_id'=> $customer_id,
            'fecha'=>$date,
            'store_number'=>$store_number,
            're' => $re,
            'sow' => $sow,
            'sub_total' => $sub_total,
            'contract_fee' =>$contract,
            'grand_total' =>$grand_total,
            'job_status' =>$job_status,
            'pay_status' =>$pay_status

        ]);

        $data->save();
        $order_id = $data->id;

        $material = 'tmp_material_table_' . $user_id;      
        $equiptment = 'tmp_equiptment_table_' . $user_id;
        $labor = 'tmp_labor_table_' . $user_id;
        $other = 'tmp_other_table_' . $user_id;


        $datos_tmp_material = DB::table($material)->get();
        $datos_tmp_equiptment = DB::table($equiptment)->get();
        $datos_tmp_labor = DB::table($labor)->get();
        $datos_tmp_other = DB::table($other)->get();

        foreach ($datos_tmp_material as $key => $value){
            $qty = $value->qty;
            $unit = $value->unit;
            $description = $value->description;
            $price = $value->price;
            $amount = $value->amount;

            DB::table('details')->insert([

                "qty" => $qty,
                "unit" => $unit,
                "description" => $description,
                "unit_price" => $price,
                "amount" => $amount,
                "id_order" => $order_id,
                "category" => "material"

            ]);

        }

        foreach ($datos_tmp_equiptment as $key => $value){
            $qty = $value->qty;
            $unit = $value->unit;
            $description = $value->description;
            $price = $value->price;
            $amount = $value->amount;

            DB::table('details')->insert([

                "qty" => $qty,
                "unit" => $unit,
                "description" => $description,
                "unit_price" => $price,
                "amount" => $amount,
                "id_order" => $order_id,
                "category" => "equiptment"

            ]);

        }

        foreach ($datos_tmp_labor as $key => $value){
            $qty = $value->qty;
            $unit = $value->unit;
            $description = $value->description;
            $price = $value->price;
            $amount = $value->amount;

            DB::table('details')->insert([

                "qty" => $qty,
                "unit" => $unit,
                "description" => $description,
                "unit_price" => $price,
                "amount" => $amount,
                "id_order" => $order_id,
                "category" => "labor"

            ]);

        }

        foreach ($datos_tmp_other as $key => $value){
            $qty = $value->qty;
            $unit = $value->unit;
            $description = $value->description;
            $price = $value->price;
            $amount = $value->amount;

            DB::table('details')->insert([

                "qty" => $qty,
                "unit" => $unit,
                "description" => $description,
                "unit_price" => $price,
                "amount" => $amount,
                "id_order" => $order_id,
                "category" => "other"

            ]);

        }
       
         $arreglo = array("msj" => "Insertado correctamente", "estatus" => 'ok');
        return response()->json($arreglo);
        
    }

}