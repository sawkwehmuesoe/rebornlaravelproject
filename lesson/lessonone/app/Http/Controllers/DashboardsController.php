<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    public function index(){
        $hay = "Hay Hay";
        $getyear = 2024;
        return view('layouts/index',compact('hay',"getyear"));
    }
}
