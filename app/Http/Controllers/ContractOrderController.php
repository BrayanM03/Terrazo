<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Material;
use App\Models\Equiptment;
use App\Models\Labor;
use App\Models\OtherExpensis;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class ContractOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index(Request $request)
    {
        
        $name = auth()->user()->name; 
        
        $request->session()->put('usuario', $name);
        $session = $request->session()->all();

        //return $session;
        return view('dash.orders.contract_order.index')->with('sesion', $session);
    }



    //Funcion para el select2
    public function getCustomers(Request $request){

        $search = $request->search;

        if($search == ''){
            $customers = Customer::orderby('name', 'ASC')
            ->select('id', 'store_number', 'name')
            ->limit(10)
            ->get();
        }else{
            $customers = Customer::orderby('name', 'ASC')
            ->select('id', 'store_number', 'name')
            ->where('name', 'like', '%' . $search . '%')
            ->limit(5)
            ->get();
        }

        $response = array();

        foreach($customers as $customer){

            $response[] = array(
                'id' => $customer->id,
                'text' => $customer->name,
                'code_store' => $customer->store_number,
            ); 
        }

        return response()->json($response);
    }

    //Funcion para el select2 - concepts
    public function getMaterials(Request $request){

        $search = $request->search;

        if($search == ''){
            $materials = Material::orderby('description', 'ASC')
            ->select('id', 'unit', 'description', 'unit_price')
            ->limit(10)
            ->get();
        }else{
            $materials = Material::orderby('description', 'ASC')
            ->select('id', 'unit', 'description', 'unit_price')
            ->where('description', 'like', '%' . $search . '%')
            ->limit(10)
            ->get();
        }

        $response = array();

        foreach($materials as $material){

            $response[] = array(
                'id' => $material->id,
                'unit' => $material->unit,
                'description' => $material->description,
                'price' => $material->unit_price,
            ); 
        }

        return response()->json($response);
    }


    public function getEquiptments(Request $request){

        $search = $request->search;

        if($search == ''){
            $Equiptments = Equiptment::orderby('description', 'ASC')
            ->select('id', 'unit', 'description', 'unit_price')
            ->limit(10)
            ->get();
        }else{
            $Equiptments = Equiptment::orderby('description', 'ASC')
            ->select('id', 'unit', 'description', 'unit_price')
            ->where('description', 'like', '%' . $search . '%')
            ->limit(10)
            ->get();
        }

        $response = array();

        foreach($Equiptments as $Equiptment){

            $response[] = array(
                'id' => $Equiptment->id,
                'unit' => $Equiptment->unit,
                'description' => $Equiptment->description,
                'price' => $Equiptment->unit_price,
            ); 
        }

        return response()->json($response);
    }


    public function getLabors(Request $request){

        $search = $request->search;

        if($search == ''){
            $labors = Labor::orderby('description', 'ASC')
            ->select('id', 'unit', 'description', 'price_per_hour')
            ->limit(10)
            ->get();
        }else{
            $labors = Labor::orderby('description', 'ASC')
            ->select('id', 'unit', 'description', 'price_per_hour')
            ->where('description', 'like', '%' . $search . '%')
            ->limit(10)
            ->get();
        }

        $response = array();

        foreach($labors as $labor){

            $response[] = array(
                'id' => $labor->id,
                'unit' => $labor->unit,
                'description' => $labor->description,
                'price' => $labor->price_per_hour,
            ); 
        }

        return response()->json($response);
    }


    public function getOtherExpenses(Request $request){

        $search = $request->search;

        if($search == ''){
            $others = OtherExpensis::orderby('description', 'ASC')
            ->select('id', 'unit', 'description', 'unit_price')
            ->limit(10)
            ->get();
        }else{
            $others = OtherExpensis::orderby('description', 'ASC')
            ->select('id', 'unit', 'description', 'unit_price')
            ->where('description', 'like', '%' . $search . '%')
            ->limit(10)
            ->get();
        }

        $response = array();

        foreach($others as $other){

            $response[] = array(
                'id' => $other->id,
                'unit' => $other->unit,
                'description' => $other->description,
                'price' => $other->unit_price,
            ); 
        }

        return response()->json($response);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id; 
        $category = $request->category; 

        $tab = 'tmp_'. $category .'_table_' . $user_id;
         
        $code = $request->code;
        $qty = $request->qty; 
        $unit = $request->unit;  
        $description = $request->description;  
        $price = $request->price; 
        $amount = $qty * $price; 

        if (Schema::hasTable($tab))
        {
            $total = DB::table($tab)->where('code', $code)->count();
    
            if($total == 0){

             DB::table($tab)->insert([
                'qty' => $qty,
                'unit' => $unit,
                'code' => $code,
                'description' => $description,
                'price' => $price,
                'amount' =>$amount
            ]);

            }else{

                $row = DB::table($tab)->where('code', $code)->first();
                $code_founded = $row->code;
                $qty_founded = $row->qty;
                $amount_founded = $row->amount;
                $total_qty = $qty_founded + $qty;

                DB::table($tab)
                    ->where('id', $code_founded)
                    ->update(['qty' => $total_qty, 'amount' => $total_qty]);

                }

            

            $arreglo = array("msj" => $total_qty); //"Se insertaron los datos"
            return response()->json($arreglo);

        }else{
            
            Schema::create($tab, function (Blueprint $table) {
                $table->id();
                $table->string('qty');
                $table->string('unit');
                $table->string('code');
                $table->string('description');
                $table->double('price', 11, 2);
                $table->double('amount', 11, 2);
                
                $table->timestamps();
            });

           
            $this_amount = $qty * $price;
            DB::table($tab)->insert([
                'qty' => $qty,
                'unit' => $unit,
                'code' => $code,
                'description' => $description,
                'price' => $price,
                'amount' => $this_amount,
            ]);

            $arreglo = array("msj" => "Se creo una tabla nueva y se insertaron datos dentro de esta.");
            return response()->json($arreglo);
        }
        
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
