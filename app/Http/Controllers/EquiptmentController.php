<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equiptment;

class EquiptmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equiptments = Equiptment::all();
        return view('dash.categories.equiptments.index')->with('equiptments', $equiptments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dash.categories.equiptments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $materials = new Equiptment();
        $materials->unit = $request->get('unit');
        $materials->description = $request->get('description');
        $materials->unit_price = $request->get('unit_price');

        $materials->save();

        return redirect('dash/categories/equiptments')->with('agregar', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equiptment = Equiptment::find($id);
        return view('dash.categories.equiptments.edit')->with('equiptment', $equiptment);
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
        $equiptment =  Equiptment::find($id);
        
        $equiptment->unit = $request->get('unit');
        $equiptment->description = $request->get('description');
        $equiptment->unit_price = $request->get('unit_price');

        $equiptment->save();

        return redirect('dash/categories/equiptments')->with('actualizar', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equiptment = Equiptment::find($id);
        $equiptment->delete();
        return redirect('/dash/categories/equiptments')->with('eliminar', 'ok');
    }
}
