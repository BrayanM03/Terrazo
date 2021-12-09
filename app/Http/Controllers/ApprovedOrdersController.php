<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovedOrdersController extends Controller
{
    //
    public function index()
    {
        return view('dash.history.approved_orders.index');
    }
}
