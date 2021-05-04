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

    public function changeIndex()
    {
        return view('pages/rooms/change-rooms');
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

    public function addRooms(Request $request)
    {
        return $this->roomRepository->addRooms($request);
    }

    public function editRooms(Request $request)
    {
        return $this->roomRepository->editRooms($request);
    }

    public function deleteRooms(Request $request)
    {
        return $this->roomRepository->deleteRooms($request->id);
    }

    public function getVacantRoomsChange(Request $request)
    {
        return $this->roomRepository->getVacantRoomsChange($request);
    }
}
