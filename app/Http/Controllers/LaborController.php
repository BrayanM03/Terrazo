<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labor;

class LaborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labors = Labor::all();
        return view('dash.categories.labors.index')->with('labors', $labors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('dash.categories.labors.create');

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
        $labors = new Labor();
        $labors->unit = $request->get('unit');
        $labors->description = $request->get('description');
        $labors->price_per_hour = $request->get('unit_price');

        $labors->save();

        return redirect('dash/categories/labors')->with('agregar', 'ok');
     
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
        $labor = Labor::find($id);
        return view('dash.categories.labors.edit')->with('labor', $labor);
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
        $labor =  Labor::find($id);
        
        $labor->unit = $request->get('unit');
        $labor->description = $request->get('description');
        $labor->price_per_hour = $request->get('unit_price');

        $labor->save();

        return redirect('dash/categories/labors')->with('actualizar', 'ok');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $labor = Labor::find($id);
        $labor->delete();
        return redirect('/dash/categories/labors')->with('eliminar', 'ok');
        
    }
}
