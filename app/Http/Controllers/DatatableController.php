<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labor;
use App\Models\Equiptment;
use App\Models\Material;
use App\Models\OtherExpensis;
use App\Models\Customer;
use App\Models\History;
use App\Models\Detail;
use yajra\Datatables\Services\DataTables;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

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

    public function getLaborTemp(){

        $user_id = auth()->user()->id; 
        $tab = 'tmp_labor_table_' . $user_id; 
        $material = DB::table($tab)->get();
 
       return datatables()->of($material)
       ->addColumn('actions',
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}},3);"><i class="fas fa-trash"></i></button>')
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

    public function getMaterialTemp(){
       
        $user_id = auth()->user()->id; 
        $tab = 'tmp_material_table_' . $user_id; 
        $material = DB::table($tab)->get();
 
       return datatables()->of($material)
       ->addColumn('actions',
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}},1);"><i class="fas fa-trash"></i></button>')
       ->rawColumns(['actions']) 
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function getMaterialDetail(Request $request){
 
        $order_id = $request->order_id;
        $material = Detail::select(['id', 'qty', 'unit', 'description', 'unit_price', 'amount'])->where('category', 'material')->Where('id_order', $order_id)->get();
 
       return datatables()->of($material)
       ->addColumn('actions',
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}},1);"><i class="fas fa-trash"></i></button>')
       ->rawColumns(['actions']) 
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function getEquiptmentDetail(Request $request){
        $order_id = $request->order_id;
        $material = Detail::select(['id', 'qty', 'unit', 'description', 'unit_price', 'amount'])->where('id_order', $order_id)->Where('category', 'equiptment')->get();
 
       return datatables()->of($material)
       ->addColumn('actions',
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}},2);"><i class="fas fa-trash"></i></button>')
       ->rawColumns(['actions']) 
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function getLaborDetail(Request $request){
        $order_id = $request->order_id;
        $material = Detail::select(['id', 'qty', 'unit', 'description', 'unit_price', 'amount'])->where('id_order', $order_id)->Where('category', 'labor')->get();
 
       return datatables()->of($material)
       ->addColumn('actions',
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}},3);"><i class="fas fa-trash"></i></button>')
       ->rawColumns(['actions']) 
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function getOtherDetail(Request $request){
        $order_id = $request->order_id;
        $material = Detail::select(['id', 'qty', 'unit', 'description', 'unit_price', 'amount'])->where('id_order', $order_id)->Where('category', 'other')->get();
 
       return datatables()->of($material)
       ->addColumn('actions',
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}},4);"><i class="fas fa-trash"></i></button>')
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

    public function getEquiptmentTemp(){

        $user_id = auth()->user()->id; 
        $tab = 'tmp_equiptment_table_' . $user_id; 
        $material = DB::table($tab)->get();
 
       return datatables()->of($material)
       ->addColumn('actions',
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}},2);"><i class="fas fa-trash"></i></button>')
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
    
    public function getOtherTemp(){

        $user_id = auth()->user()->id; 
        $tab = 'tmp_other_table_' . $user_id; 
        $material = DB::table($tab)->get();
 
       return datatables()->of($material)
       ->addColumn('actions',
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}},4);"><i class="fas fa-trash"></i></button>')
       ->rawColumns(['actions']) 
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function customer(){ 
        $customers = Customer::select(['id', 'store_number', 'name', 'address', 'number', 'email']);//->get();
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

    public function getHistory(){ 
        $customers = History::select(['id', 'customer_name', 'fecha', 'store_number', 're', 'sow', 'sub_total', 'contract_fee', 'grand_total', 'job_status', 'pay_status', 'created_at'])->where('job_status', 'Pending');//->get();
       // return $labor;
       return datatables()->of($customers)
       ->addColumn('actions', 
       '<form action="{{ route ("pending_orders.destroy", $id )}}" id="{{$id}}" class="eliminar_customers" method="POST" style="display:flex;">'.
      /*  '<a href="customers/{{ $id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>'. */
       '<a href="pending_orders/{{$id}}/edit" class="btn btn-success"><i class="fas fa-file-excel"></i></a>'.
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}});"><i class="fas fa-trash"></i></button>'.
       '</form>')
       ->rawColumns(['actions'])
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function getHistoryApproved(){ 
        $customers = History::select(['id', 'customer_name', 'fecha', 'store_number', 're', 'sow', 'sub_total', 'contract_fee', 'grand_total', 'job_status', 'pay_status', 'created_at'])->where('job_status', 'Approved');//->get();
       // return $labor;
       return datatables()->of($customers)
       ->addColumn('actions', 
       '<form action="{{ route ("pending_orders.destroy", $id )}}" id="{{$id}}" class="eliminar_customers" method="POST" style="display:flex;">'.
      /*  '<a href="customers/{{ $id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>'. */
       '<a href="pending_orders/{{$id}}/edit" class="btn btn-success"><i class="fas fa-file-excel"></i></a>'.
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}});"><i class="fas fa-trash"></i></button>'.
       '</form>')
       ->rawColumns(['actions'])
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function getHistoryCompleted(){ 
        $customers = History::select(['id', 'customer_name', 'fecha', 'store_number', 're', 'sow', 'sub_total', 'contract_fee', 'grand_total', 'job_status', 'pay_status', 'created_at'])->where('job_status', 'Completed')->orWhere('job_status', 'Canceled');//->get();
       // return $labor;
       return datatables()->of($customers)
       ->addColumn('actions', 
       '<form action="{{ route ("pending_orders.destroy", $id )}}" id="{{$id}}" class="eliminar_customers" method="POST" style="display:flex;">'.
      /*  '<a href="customers/{{ $id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>'. */
       '<a href="pending_orders/{{$id}}/edit" class="btn btn-success"><i class="fas fa-file-excel"></i></a>'.
       '@csrf'.
       '<input type="hidden" name="_method" value="DELETE">' .
       '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}});"><i class="fas fa-trash"></i></button>'.
       '</form>')
       ->rawColumns(['actions'])
       ->toJson();
       /* return DataTables::of($labor)->make(); */
      
    }

    public function getHistoryGeneral(){

        $customers = History::select(['id', 'customer_name', 'fecha', 'store_number', 're', 'sow', 'sub_total', 'contract_fee', 'grand_total', 'job_status', 'pay_status', 'created_at']);//->get();
        // return $labor;
        return datatables()->of($customers)
        ->addColumn('actions', 
        '<form action="{{ route ("pending_orders.destroy", $id )}}" id="{{$id}}" class="eliminar_customers" method="POST" style="display:flex;">'.
        '<a href="change_order/{{ $id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>'.
        '<a href="change_order/{{$id}}/edit" class="btn btn-success ml-2"><i class="fas fa-file-excel"></i></a>'.
        '@csrf'.
        '<input type="hidden" name="_method" value="DELETE">' .
        '<button type="submit" class="btn btn-danger ml-2" name="enviar" onclick="Llamar(event, {{$id}});"><i class="fas fa-trash"></i></button>'.
        '</form>')
        ->rawColumns(['actions'])
        ->toJson();

    }
}
