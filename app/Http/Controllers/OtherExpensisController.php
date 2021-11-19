<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherExpensis;

class OtherExpensisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $other_expenses = OtherExpensis::all();
        return view('dash.categories.other_expenses.index')->with('other_expenses', $other_expenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('dash.categories.other_expenses.create');

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
        $other_expenses = new OtherExpensis();
        $other_expenses->unit = $request->get('unit');
        $other_expenses->description = $request->get('description');
        $other_expenses->unit_price = $request->get('unit_price');

        $other_expenses->save();

        return redirect('dash/categories/other_expenses')->with('agregar', 'ok');
       
     
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
        $other_expense = OtherExpensis::find($id);
        return view('dash.categories.other_expenses.edit')->with('other_expense', $other_expense);
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
        $other_expense =  OtherExpensis::find($id);
        
        $other_expense->unit = $request->get('unit');
        $other_expense->description = $request->get('description');
        $other_expense->unit_price = $request->get('unit_price');

        $other_expense->save();

        return redirect('dash/categories/other_expenses')->with('actualizar', 'ok');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $other_expense = OtherExpensis::find($id);
        $other_expense->delete();
        return redirect('/dash/categories/other_expenses')->with('eliminar', 'ok');
        
    }
}
