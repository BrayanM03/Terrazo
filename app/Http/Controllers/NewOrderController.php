<?php

namespace App\Http\Controllers;


class NewOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$equiptments = Equiptment::all();
        return view('dash.orders.index');
    }

  
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('dash.orders.contract_order.index');
    }
    
}
