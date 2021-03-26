<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Http\Repositories\ReservationRepository;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function index()
    {
        return view('pages/reservation/reservation');
    }

    public function getReservationUpcoming()
    {
        return $this->reservationRepository->getReservationUpcoming();
    }

    public function getReservationOngoing()
    {
        return $this->reservationRepository->getReservationOngoing();
    }

    public function createReservation(ReservationRequest $request)
    {
        return $this->reservationRepository->createReservation($request);
    }

    public function checkReservation(Request $request)
    {
        return $this->reservationRepository->checkReservation($request);
    }

    public function savePayment(Request $request)
    {
        return $this->reservationRepository->savePayment($request);
    }

    public function deleteReservation(Request $request)
    {
        return $this->reservationRepository->deleteReservation($request);
    }

    public function checkIn(Request $request)
    {
        return $this->reservationRepository->checkIn($request);
    }

    public function checkOut(Request $request)
    {
        return $this->reservationRepository->checkOut($request);
    }

    public function payCash(Request $request)
    {
        return $this->reservationRepository->payCash($request);
    }
}
