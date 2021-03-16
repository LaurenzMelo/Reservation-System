<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('pages/website/index');
    }

    public function rooms()
    {
        return view('pages/website/rooms-list');
    }

    public function facilities()
    {
        return view('pages/website/facilities');
    }

    public function contact_us()
    {
        return view('pages/website/contact-us');
    }

    public function booking()
    {
        return view('pages/website/booking');
    }

    public function details()
    {
        return view('pages/website/booking-details');
    }
}
