<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\RoomRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function index()
    {
        return view('pages/rooms/list-of-rooms');
    }

    public function getRooms()
    {
        return $this->roomRepository->getRooms();
    }

    public function getRoomsWebsite()
    {
        return $this->roomRepository->getRoomsWebsite();
    }

    public function getVacantRooms(Request $request)
    {
        return $this->roomRepository->getVacantRooms($request);
    }
}
