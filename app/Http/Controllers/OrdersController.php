<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;


class OrdersController extends Controller
{
    //

    function saveHeader(Request $request)
    {
        $curstomer_id = $request->curstomer_id;
        $date = $request->date;
        $re = $request->re;
        $sow = $request->sow;
        $store_number = $request->store_number;

        $request->session()->put('customer_id', $curstomer_id);
        $request->session()->put('date', $date);
        $request->session()->put('re', $re);
        $request->session()->put('sow', $sow);
        $request->session()->put('store_number', $store_number);
        
    }

    function register(Request $request)
    {
        $user_id = auth()->user()->id; 
        $curstomer_id =  $request->session()->get('customer_id');
        $date = $request->session()->get('date');
        $re = $request->session()->get('re');
        $sow = $request->session()->get('sow');
        $store_number =$request->session()->get('store_number');

        $material = 'tmp_material_table_' . $user_id;      
        $equiptment = 'tmp_equiptment_table_' . $user_id;
        $labor = 'tmp_labor_table_' . $user_id;
        $other = 'tmp_other_table_' . $user_id;


        $datos_tmp_material = DB::table($material)->get();
        $datos_tmp_equiptment = DB::table($equiptment)->get();
        $datos_tmp_labor = DB::table($labor)->get();
        $datos_tmp_other = DB::table($other)->get();

        




       
        
        
       
        
        
    }

}
