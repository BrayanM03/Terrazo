<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("America/Matamoros");

use Illuminate\Http\Request;
use App\Models\Detail;

class detailsChangeOrder extends Controller
{
    //
    public function add(Request $request){
        $category =  $request->category;
        $qty = $request->qty;
        $unit = $request->unit;
        $code = $request->code;
        $unit_price = $request->price;
        $order_id = $request->order_id;
        $amnt = $unit_price * $qty;
        $amount = round($amnt,2); 

        switch ($category) {
            case "material":
            $tab = "materials";
            $datatable = "tab1";
            break;
            
            case "equiptment":
            $tab = "equiptments";
            $datatable = "tab2";
            break;

            case "labor":
            $tab = "labors";
            $datatable = "tab3";
            break;

            case "other":
            $tab = "other_expenses";
            $datatable = "tab4";
            break;     
        }

        //Comprobamos la existencia del mismo concepto 
        $count = DB::table('details')->where('code', $code)->where('id_order', $order_id)->where('category', $category)->count();

        $detail_row = DB::table($tab)->where('id', $code)->get();
         $description = $detail_row[0]->description;
        
        if($count == 0){
            DB::table('details')->insert([
                ["qty"=> $qty, "unit"=> $unit, "code"=> $code, "description"=> $description, "unit_price"=> $unit_price, "amount"=> $amount,
                "id_order"=> $order_id, "category" =>$category, "estatus" => "incomplet"] 
            ]);

            $amount_total = DB::table('details')->where('id_order', $order_id)->where('category', $category)->sum('amount');

            $response = array("datatable" => $datatable, "total_am"=> $amount_total);

        }else{
            $this_detail = DB::table('details')->where('code', $code)->where('id_order', $order_id)->where('category', $category)->get();
            $id_detail = $this_detail[0]->id;
            $actual_amount = $this_detail[0]->amount;
            $actual_qty = $this_detail[0]->qty;
            $new_qty = $actual_qty + $qty;
            $total = $actual_amount + $amount;
            $new_amount = round($total, 2);
            $query = DB::table('details')->where('id', $id_detail)->update([
                    "qty"=> $new_qty, "amount"=>$new_amount
            ]);

            $amount_total = DB::table('details')->where('id_order', $order_id)->where('category', $category)->sum('amount');

            $response = array("datatable" => $datatable, "total_am"=> $amount_total);

            
        }


     
        return $response;


    }

    public function getNumbers(Request $request){

        $order_id =$request->order_id;
        $category = $request->category;
        $amount_total = DB::table('details')->where('id_order', $order_id)->sum('amount');
        $total = round($amount_total, 2);
        $sub_total = $total;
        $percent = 7;
        $contract = ($percent / 100) * $sub_total;
        $contract_total = round($contract, 2);
        $grand_total_in = $contract_total + $sub_total;
        $grand_total = round($grand_total_in, 2);


        $customer_id =  $request->session()->get('customer_id');
        $customer_name = $request->session()->get('customer_name');
        $date = $request->session()->get('date');
        $re = $request->session()->get('re');
        $sow = $request->session()->get('sow');
        $store_number =$request->session()->get('store_number');
        $proyect = $request->session()->get('proyect');
        $units = $request->session()->get('units');
        $direction = $request->session()->get('direction');
      
        $job_status = "Pending";
        $pay_status = "Unpaid";
      
        DB::table("histories")->where('id', $order_id)->update([
            "customer_id"=> $customer_id, "customer_name"=> $customer_name,
            "fecha"=>$date, "store_number"=> $store_number, "proyect"=> $proyect,
            "direction"=> $direction, "units"=> $units, "re"=> $re, "sow"=> $sow,
            "sub_total"=>$total, "contract_fee"=>$contract_total, "grand_total"=>$grand_total,

        ]);

        $arreglo = array("msj" => "OKKK.",
                         "sub_total" => $sub_total,
                         "contract_total" => $contract_total,
                         "grand_total" => $grand_total);
        return response()->json($arreglo);

    }


    public function check(Request $request){

        $order_id = $request->order_id;
        $amount_total = DB::table('details')->where('id_order', $order_id)->sum('amount');
        $amount_material = DB::table('details')->where('id_order', $order_id)->where('category', 'material')->sum('amount');
        $amount_equiptment = DB::table('details')->where('id_order', $order_id)->where('category', 'equiptment')->sum('amount');
        $amount_labor = DB::table('details')->where('id_order', $order_id)->where('category', 'labor')->sum('amount');
        $amount_other = DB::table('details')->where('id_order', $order_id)->where('category', 'other')->sum('amount');

        $total = round($amount_total, 2);
        $sub_total = $total;
        $percent = 7;
        $contract = ($percent / 100) * $sub_total;
        $contract_total = round($contract, 2);
        $grand_total_in = $contract_total + $sub_total;
        $grand_total = round($grand_total_in, 2);

      
        
        $arreglo = array("msj" => "OKKK.",
                         "sub_total" => $sub_total,
                         "contract_total" => $contract_total,
                         "grand_total" => $grand_total,
                         "amount_material" => $amount_material,
                         "amount_equiptment"=> $amount_equiptment,
                         "amount_labor"=> $amount_labor,
                         "amount_other"=> $amount_other);
        return response()->json($arreglo);
    }


    public function destroy(Request $request){

        $category = $request->category;
        $id = $request->id;


        switch ($category) {
            case "material":
                $datatable = "tab1";
                break;

            case "equiptment":
                $datatable = "tab2";
                break;

            case "labor":
                $datatable = "tab3";
                break;

            case "other":
                $datatable = "tab4";
                break;            
        
            default:
                break;
        }
      
        DB::table("details")->where('id', $id)->delete();
        
        $order_id = $request->order_id;
        $amount_total = DB::table('details')->where('id_order', $order_id)->sum('amount');
        $amount_category = DB::table('details')->where('id_order', $order_id)->where('category', $category)->sum('amount');

        

        $total = round($amount_total, 2);
        $sub_total = $total;
        $percent = 7;
        $contract = ($percent / 100) * $sub_total;
        $contract_total = round($contract, 2);
        $grand_total_in = $contract_total + $sub_total;
        $grand_total = round($grand_total_in, 2);

        
        $customer_id =  $request->session()->get('customer_id');
        $customer_name = $request->session()->get('customer_name');
        $date = $request->session()->get('date');
        $re = $request->session()->get('re');
        $sow = $request->session()->get('sow');
        $store_number =$request->session()->get('store_number');
        $proyect = $request->session()->get('proyect');
        $units = $request->session()->get('units');
        $direction = $request->session()->get('direction');
  
        $job_status = "Pending";
        $pay_status = "Unpaid";
      
        DB::table("histories")->where('id', $order_id)->update([
            "customer_id"=> $customer_id, "customer_name"=> $customer_name,
            "fecha"=>$date, "store_number"=> $store_number, "proyect"=> $proyect,
            "direction"=> $direction, "units"=> $units, "re"=> $re, "sow"=> $sow,
            "sub_total"=>$sub_total, "contract_fee"=>$contract, "grand_total"=>$grand_total,

        ]);

        $arreglo = array("msj" => "OKKK.",
        "sub_total" => $sub_total,
        "contract_total" => $contract_total,
        "grand_total" => $grand_total,
        "total_am" => $amount_category,
        "datatable" => $datatable,
        "id_order" => $order_id,);
     

        return response()->json($arreglo);

    }
}
