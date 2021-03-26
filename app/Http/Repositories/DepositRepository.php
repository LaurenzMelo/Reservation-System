<?php


namespace App\Http\Repositories;

use App\Models\Deposit;
use App\Models\Reservation;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class DepositRepository
{
    public function getDeposit()
    {
        return Deposit::with('reservation')
            ->where('isAcknowledged', 0)
            ->get();
    }

    public function getApprovedDeposit()
    {
        return Deposit::with('reservation')
            ->where('isAcknowledged', 1)
            ->get();
    }

    public function approvePayment($request)
    {
        /*dd($request->all());*/
        $amount = $request->selected['amount'];

        Deposit::where('id', $request->selected['id'])
            ->update([
                'isAcknowledged' => 1,
            ]);

        $res = Reservation::where('id', $request->selected['reservation_id'])->first();

        $amount += $res['payment'];

        if($amount == $res['amount']) {
            $changeResNo = $res['last_name'] . '_' . $res['reservation_no'];

            Reservation::where('id', $request->selected['reservation_id'])
                ->update([
                    'reservation_no' => $changeResNo,
                    'payment' => $amount,
                    'is_paid' => 1,
                ]);
        } else {
            Reservation::where('id', $request->selected['reservation_id'])
                ->update([
                    'payment' => $amount,
                ]);
        }

        //Send Email Here
    }

    public function disapprovePayment($request)
    {
        return Deposit::where('id', $request->selected['id'])->delete();
        //Send Email Here
    }

    public function revertPayment($request)
    {
        $amount = $request->selected['amount'];

        Deposit::where('id', $request->selected['id'])
            ->update([
                'isAcknowledged' => 0,
            ]);

        $res = Reservation::where('id', $request->selected['reservation_id'])->first();

        $amount = $res['payment'] - $amount;

        if($res['is_paid'] == 1) {
            Reservation::where('id', $request->selected['reservation_id'])
                ->update([
                    'payment' => $amount,
                    'is_paid' => 0,
                ]);
        } else {
            Reservation::where('id', $request->selected['reservation_id'])
                ->update([
                    'payment' => $amount,
                ]);
        }


        //Send Email Here
    }
}
