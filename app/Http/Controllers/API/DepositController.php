<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\DepositRepository;

class DepositController extends Controller
{
    private $depositRepository;

    public function __construct(DepositRepository $depositRepository)
    {
        $this->depositRepository = $depositRepository;
    }

    public function index()
    {
        return view('pages/deposits/deposit');
    }

    public function getDeposit()
    {
        return $this->depositRepository->getDeposit();
    }

    public function getApprovedDeposit()
    {
        return $this->depositRepository->getApprovedDeposit();
    }

    public function getDisapprovedDeposit()
    {
        return $this->depositRepository->getDisapprovedDeposit();
    }

    public function approvePayment(Request $request)
    {
        return $this->depositRepository->approvePayment($request);
    }

    public function disapprovePayment(Request $request)
    {
        return $this->depositRepository->disapprovePayment($request);
    }

    public function revertPayment(Request $request)
    {
        return $this->depositRepository->revertPayment($request);
    }

    public function revertDisapprove(Request $request)
    {
        return $this->depositRepository->revertDisapprove($request);
    }
}
