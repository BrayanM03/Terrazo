<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HistoryExport;
use App\Exports\CostExport;
use App\Exports\GeneralReportExport;
use App\Models\History;
use App\Models\Customer;
use App\Models\Detail;


class ChangeOrderController extends Controller
{
    //
    public function index(Request $request){
        $name = auth()->user()->name; 
        
        $request->session()->put('usuario', $name);
        $session = $request->session()->all();

        //return $session;
        return view('dash.orders.change_order.index')->with('sesion', $session);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function esdit($id)
    {
        $orden = History::find($id);
        $customer_id = $orden->customer_id;
        $customer_row = Customer::find($customer_id);
        $customer_name = $customer_row->name;
        $date = $orden->fecha;
        $store_number =$orden->store_number;
        $proyect = $orden->proyect;
        $direction = $orden->direction;
        $re = $orden->re;
        $sow = $orden->sow;
        $sub_total = $orden->sub_total;
        $contract_fee = $orden->contract_fee;
        $grand_total = $orden->grand_total;
        $job_status = $orden->job_status;
        $pay_status = $orden->pay_status;

       
        $count = Detail::whereRaw('id_order ='.$id .' and category= "material"')->count();
        if($count > 0){
            
            $totalCostMaterial = 0;
            $order_detail = Detail::whereRaw('id_order ='.$id .' and category= "material"')->get();
            foreach($order_detail as $value){
                $unit = $value->unit;
                $description = $value->description;
                $qty = $value->qty;
                $unit_price = $value->unit_price;
                $amount = $value->amount;
                $totalCostMaterial = $totalCostMaterial + $amount;
                $dataMaterial[] = array('unit' => $unit, 
                                'description' => $description, 
                                'qty' => $qty,
                                'unit_price' =>'$ '. $unit_price,
                                'amount' => '$ '.$amount);
            
            }

            
            //echo json_encode($data);
        }else{
            $dataMaterial[] = array('message'=> 'No hay datos');
            $totalCostMaterial = 0;
        }

        $count2 = Detail::whereRaw('id_order ='.$id .' and category= "equiptment"')->count();
        if($count2 > 0){
            
            $totalCostEquiptment =0;
            $order_detail = Detail::whereRaw('id_order ='.$id .' and category= "equiptment"')->get();
            foreach($order_detail as $value){
                $unit = $value->unit;
                $description = $value->description;
                $qty = $value->qty;
                $unit_price = $value->unit_price;
                $amount = $value->amount;
                $totalCostEquiptment = $totalCostEquiptment + $amount;

                $dataEquipment[] = array('unit' => $unit, 
                                'description' => $description, 
                                'qty' => $qty,
                                'unit_price' =>'$ '. $unit_price,
                                'amount' =>'$ '. $amount);
            
            }
            //echo json_encode($data);
        }else{
            $dataEquipment[] = array('message'=> 'No hay datos');
            $totalCostEquiptment = 0;
        }

        $count3 = Detail::whereRaw('id_order ='.$id .' and category= "labor"')->count();
        if($count3 > 0){
            
            $totalCostLabor =0;
            $order_detail = Detail::whereRaw('id_order ='.$id .' and category= "labor"')->get();
            foreach($order_detail as $value){
                $unit = $value->unit;
                $description = $value->description;
                $qty = $value->qty;
                $unit_price = $value->unit_price;
                $amount = $value->amount;
                $totalCostLabor = $totalCostLabor + $amount;

                $dataLabor[] = array('unit' => $unit, 
                                'description' => $description, 
                                'qty' => $qty,
                                'unit_price' => '$ '.$unit_price,
                                'amount' => '$ '.$amount);
            
            }
            //echo json_encode($data);
        }else{
            $dataLabor[] = array('message'=> 'No hay datos');
            $totalCostLabor = 0;
        }

        $count4 = Detail::whereRaw('id_order ='.$id .' and category= "other"')->count();
        if($count4 > 0){
            
            $totalCostOther =0;
            $order_detail = Detail::whereRaw('id_order ='.$id .' and category= "other"')->get();
            foreach($order_detail as $value){
                $unit = $value->unit;
                $description = $value->description;
                $qty = $value->qty;
                $unit_price = $value->unit_price;
                $amount = $value->amount;
                $totalCostOther = $totalCostOther + $amount;
                $dataOther[] = array('unit' => $unit, 
                                'description' => $description, 
                                'qty' => $qty,
                                'unit_price' =>'$ '. $unit_price,
                                'amount' => '$ '.$amount);
            
            }
            //echo json_encode($data);
        }else{
            $dataOther[] = array('message'=> 'No hay datos');
            $totalCostOther =0;
        }

           $details = [
           [''],
           [''],
           [''],
           [''],
           ['TO: ', $customer_name, 'DATE: ', $date],
           ['ATTN PUBLIX: ', $store_number],
           ["RE: ", $re],
           ["Scope Of Work Provided by Publix Supermarkets"],
           ['SOW: ', $sow],
           [''],
           ['UNIT', 'MATERIAL', 'QTY', 'UNIT PRICE', 'AMOUNT'],
           $dataMaterial,
           [''],
           ['UNIT', 'EQUIPTMENT', 'QTY', 'UNIT PRICE', 'AMOUNT'],
           $dataEquipment,
           [''],
           ['UNIT', 'LABOR', 'QTY', 'PRICE P/HOUR', 'AMOUNT'],
           $dataLabor,
           [''],
           ['UNIT', 'OTHER EXPENSES', 'QTY', 'UNIT PRICE', 'AMOUNT'],
           $dataOther,
           [''],
           ['','','','Sub total', '$ '.$sub_total],
           ['','','','7% Contract Fee', '$ '.$contract_fee],
           ['','','','GRAND TOTAL', '$ '.$grand_total],
           ['']
        ];

        //Este arreglo se ira a la segunda hoja del excel

        $costs = [[''],
        [''],
        [''],
        [''],
        ['TO: ', $customer_name, 'DATE: ', $date],
        ['ATTN PUBLIX: ', $store_number],
        ["RE: ", $re],
        ["Scope Of Work Provided by Publix Supermarkets"],
        ['SOW: ', $sow],
        [''],
        [''],
        ['LABOR:', 'HOURS WORKED X ACTUAL RATE $36.00/$50.00 % of Labor Burden = 50%'],
        ['TOTAL LABOR: ', '$ '. $totalCostLabor],
        ['MATERIALS:(Itemized Costs): ', '$ '. $totalCostMaterial],
        ['EQUIPTMENT:(Itemized Costs)', '$ '. $totalCostEquiptment],
        ['ANY OTHER COSTS: ', '$ '. $totalCostOther],
        ['SUBCONTRACTOR FEE 7%: ', '$ ' . $contract_fee],
        ['GRAND TOTAL: ' , '$ ' . $grand_total],
        [''],
        [''],
        ['','Sincerely: '],
        ['','___________________'],
        ['','President']
    ];


        $total = [[''],
        [''],
        [''],
        [''],
        ['Att: ', $customer_name],
        ['Proyect: ', $proyect ],
        ['Direction', $direction],
        ['We propose to Furnish & install MMA SYSTEM Under Conditions Specified Below:'],
        ['AS PER: A02.02'],
        ['DATE:', $date],
        ['Conditions Governing this Proposal (As Applicable):'],
        [$sow],
        ['Total: ', '$ ' .$grand_total],
        ['1. All electric current sufficient, lightning, water, heat, trash removal and hosting facilities shall be furnished at no expense to us.
        2. All of the above conditions form the basis of our estimate and shall become a part of ant subcontract entered into even if not signed by the addressee and typed into the subcontract prepared by the addressee.
        3. Progress billing will be monthly, due within 5 days, and the balance to be due upon completion. If progress and final payment are not received within (10) days after billing, interest shall accrue at the rate of 1% per month. This shall constitute the total agreement for payment  on this project, unless other means or method are agreed upon in writing.
        4. All Work to be Performed During regular working hours (Straight Time) unless specifically included above.
        5. Any extras to this contract for which a stipulated sum cannot be arrived upon, shall be performed on a “cost plus” basic, i.e. Labor cost, plus material cost 25% markup for overhead, plus 10% markup for profit.
        6. JJ Terrazzo Tile LLC is not responsible for any loss of revenue while scope work being performed. This proposal is subject to acceptance
        within-90-days and be voided or escalated at the option of the undersigned.'],
        ['','Company:', '_______________'],
        ['','Printed name:', '_______________'],
        ['','Accepted By:', '_______________'],
        [''],
        [''],
        ['JJ TERRAZZO & TILE LLC'],
        ['JOSE RESENDIZ'],
        ['PRESIDENT']];

        $exports = [$details, $costs, $total];
        $generalExport = new GeneralReportExport($exports);
        $generalExport->sheets($exports);
        
        

        return Excel::download($generalExport, 'ORDER_'. $id .'.xlsx');

        
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $order = History::find($id);
        return view('dash.orders.change_order.update')->with('order', $order);

    }
}
