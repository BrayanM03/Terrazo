<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labor;
use App\Models\Equiptment;
use App\Models\Material;
use App\Models\OtherExpensis;
use App\Models\Customer;
use yajra\Datatables\Services\DataTables;


class DatatableController extends Controller
{
    //
    public function labor(){ 
        $labor = Labor::select(['id', 'unit', 'description', 'price_per_hour']);//->get();
       // return $labor;
       return datatables()->of($labor)
       ->addColumn('actions', 
       '<form action="{{ route ("labors.destroy", $id )}}" id="{{$id}}" class="eliminar_labor" method="POST" style="display:flex;">'.
       '<a href="labors/{{ $id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>'.
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}});"><i class="fas fa-trash"></i></button>'.
       '</form>')
       ->rawColumns(['actions'])
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }


    public function material(){ 
        $material = Material::select(['id', 'unit', 'description', 'unit_price']);//->get();
       // return $labor;
       return datatables()->of($material)
       ->addColumn('actions', 
       '<form action="{{ route ("materials.destroy", $id )}}" id="{{$id}}" class="eliminar_material" method="POST" style="display:flex;">'.
       '<a href="materials/{{ $id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>'.
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}});"><i class="fas fa-trash"></i></button>'.
       '</form>')
       ->rawColumns(['actions'])
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }


    public function equiptment(){ 
        $equiptment = Equiptment::select(['id', 'unit', 'description', 'unit_price']);//->get();
       // return $labor;
       return datatables()->of($equiptment)
       ->addColumn('actions', 
       '<form action="{{ route ("equiptments.destroy", $id )}}" id="{{$id}}" class="eliminar_equiptment" method="POST" style="display:flex;">'.
       '<a href="equiptments/{{ $id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>'.
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}});"><i class="fas fa-trash"></i></button>'.
       '</form>')
       ->rawColumns(['actions'])
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function other_expenses(){ 
        $other_expenses = OtherExpensis::select(['id', 'unit', 'description', 'unit_price']);//->get();
       // return $labor;
       return datatables()->of($other_expenses)
       ->addColumn('actions', 
       '<form action="{{ route ("other_expenses.destroy", $id )}}" id="{{$id}}" class="eliminar_labor" method="POST" style="display:flex;">'.
       '<a href="other_expenses/{{ $id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>'.
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}});"><i class="fas fa-trash"></i></button>'.
       '</form>')
       ->rawColumns(['actions'])
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function customer(){ 
        $customers = Customer::select(['id', 'name', 'address', 'number', 'email']);//->get();
       // return $labor;
       return datatables()->of($customers)
       ->addColumn('actions', 
       '<form action="{{ route ("customers.destroy", $id )}}" id="{{$id}}" class="eliminar_customers" method="POST" style="display:flex;">'.
       '<a href="customers/{{ $id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>'.
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}});"><i class="fas fa-trash"></i></button>'.
       '</form>')
       ->rawColumns(['actions'])
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }
}
