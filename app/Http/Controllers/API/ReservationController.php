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
}
