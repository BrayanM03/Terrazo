<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompletedOrdersController extends Controller
{
    //
    public function index()
    {
        return view('dash.history.orders_completed.index');
    }
}
