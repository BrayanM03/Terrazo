<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class ContractOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
        return view('dash.orders.contract_order.index');
    }

    //Funcion para el select2
    public function getCustomers(Request $request){

        $search = $request->search;

        if($search == ''){
            $customers = Customer::orderby('name', 'ASC')
            ->select('id', 'name')
            ->limit(10)
            ->get();
        }else{
            $customers = Customer::orderby('name', 'ASC')
            ->select('id', 'name')
            ->where('name', 'like', '%' . $search . '%')
            ->limit(5)
            ->get();
        }

        $response = array();

        foreach($customers as $customer){

            $response[] = array(
                'id' => $customer->id,
                'text' => $customer->name,
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
        //
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
