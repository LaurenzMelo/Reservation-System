<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages/report/report');
    }

    public function download(Request $request)
    {
        dd($request->all());
    }
}
