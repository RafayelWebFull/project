<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report() {
       $reports = DB::table('report')->get();
       $count  = $reports->sum('broker_rate');
       return view('reports', ['reports'=> $reports, 'count_rent'=> $count]);
    }
}
