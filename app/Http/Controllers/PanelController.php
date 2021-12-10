<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    //
    public function getData(){

        $pending_count = DB::table('histories')->where('job_status', 'Pending')->count();
        $approved_count = DB::table('histories')->where('job_status', 'Approved')->count();
        $terminated_count = DB::table('histories')->where('job_status', 'Completed')->count();
        $canceled_count = DB::table('histories')->where('job_status', 'Canceled')->count();

        $response = array("pending_orders"=>$pending_count, "approved_orders"=> $approved_count, "termined_orders"=>$terminated_count,"canceled_orders"=> $canceled_count);
        return $response;
    }
}
