<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages/report/report');
    }

    public function download(Request $request)
    {
        // dd(json_decode($request->date)->start);
        // dd($request->all());
        date_default_timezone_set('Asia/Manila');
        $columns = [];
        $col_data = [];
        
        $profit = $request->profit;
        $res = $request->res;
        $start_date = Carbon::parse($request->date['start'])->addDays(1)->startOfDay();
        $end_date = Carbon::parse($request->date['end'])->addDays(1)->endOfDay();

        $query = DB::table('reservations');

        foreach($request->res as $res) {
            if($res === 'full_name') {
                $query->addSelect('first_name');
                $query->addSelect('last_name');
            } else if ($res === 'start_date') {
                $query->addSelect('reservation_details.start_date');
            } else if ($res === 'end_date') {
                $query->addSelect('reservation_details.end_date');
            } else {
                $query->addSelect($res);
            }
        }

        $query->leftJoin('reservation_details', 'reservation_details.reservation_id', '=', 'reservations.id');

        $result = $query->whereBetween('reservation_details.start_date', [$start_date, $end_date])->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        foreach($request->res as $col) {
            if ($col === 'reservation_no') {
                array_push($columns, 'Reservation Number');
                array_push($col_data, $col);
            } else if ($col === 'full_name') {
                array_push($columns, 'First Name');
                array_push($columns, 'Last Name');
                array_push($col_data, 'first_name');
                array_push($col_data, 'last_name');
            } else if ($col === 'email') {
                array_push($columns, 'Email');
                array_push($col_data, $col);
            } else if ($col === 'contact_no') {
                array_push($columns, 'Contact Number');
                array_push($col_data, $col);
            } else if ($col === 'start_date') {
                array_push($columns, 'Start Date');
                array_push($col_data, $col);
            }  else if ($col === 'end_date') {
                array_push($columns, 'End Date');
                array_push($col_data, $col);
            } else if ($col === 'amount') {
                array_push($columns, 'Amount');
                array_push($col_data, $col);
            } else {
                array_push($columns, $col);
                array_push($col_data, $col);
            }
        }
        
        $callback = function() use ($result, $columns, $col_data)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach($result as $r) {
                $row_data = [];
                foreach($col_data as $data) {
                    array_push($row_data, $r->$data);
                }
                fputcsv($file, $row_data);
            }
            fclose($file);
        };

        return response()->streamDownload($callback, 'prefix-' . date('d-m-Y-H:i:s').'.csv', $headers);
    }

}
