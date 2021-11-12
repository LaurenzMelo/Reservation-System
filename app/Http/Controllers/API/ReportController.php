<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages/report/report');
    }

    public function download(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        
        $profit = $request->profit;
        $res = $request->res;
        $start_date = Carbon::parse($request->date['start'])->addDays(1)->startOfDay();
        $end_date = Carbon::parse($request->date['end'])->addDays(1)->endOfDay();

        // $reservation = Reservation::where()
    }
}
