<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labor;
use yajra\Datatables\Services\DataTables;


class DatatableController extends Controller
{
    //
    public function labor(){ 
        $labor = Labor::select(['id', 'unit', 'description', 'price_per_hour']);//->get();
       // return $labor;
       return datatables()->of($labor)
       ->addColumn('actions', 
       '<form action="{{ route ("labor.destroy", $id )}}" class="eliminar_labor" method="POST" style="display:flex;">'.
       '<a href="labors/{{ $id}}/edit" class="btn btn-warning">Edit</a>'.
       '@csrf'.
       '@method("DELETE")' .
       '<button class="btn btn-danger"><i class="fas fa-trash"></i></button>'.
       '</form>')
       ->rawColumns(['actions'])
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }
}
