<?php


namespace App\Http\Repositories;

use App\Models\Deposit;
use App\Models\Reservation;
use App\Models\ReservationDetails;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class ReservationRepository
{
    public function createReservation($request)
    {
        /*dd($request->all());*/
        $date_tomorrow = Carbon::now()->addDays(1)->setTimezone('Singapore');

        $reservation_no = rand(1111111111,9999999999);

        $r = new Reservation;
        $r->reservation_no = $reservation_no;
        $r->first_name = $request->first_name;
        $r->last_name = $request->last_name;
        $r->email = $request->email;
        $r->contact_no = $request->contact_no;
        $r->requests = $request->requests;
        $r->amount = $request->amount;
        $r->guest_no = $request->guest_no;
        $r->is_active = 1;
        $r->expiry_date = $date_tomorrow;
        $r->save();

        /*dd($r->id);*/
        $rooms = $request->rooms;

        for($i = 0; $i < count($rooms); $i++) {
            ReservationDetails::create([
                'reservation_id' => $r->id,
                'room_id' => $rooms[$i]['id'],
                'start_date' => $request->check_in,
                'end_date' => $request->check_out,
            ]);
        }
    }

    public function checkReservation($request)
    {
        $res_no = $request->res_no;

        $data['details'] = Reservation::where('reservation_no', $res_no)
            ->with(['reservation_details' => function ($query) {
                $query->with('rooms');
            }])
            ->get()
            ->first();

        return response()->json($data);
    }

    public function savePayment($request)
    {
        $payment = null;
        $getResId = Reservation::where('reservation_no', $request->res_no)->pluck('id')->first();

        if ($getResId != null) {
            if ($request->file('payment_slip') != null) {
                $file = $request->file('payment_slip');

                $fileName1 = $file->getClientOriginalName();

                $request->file('payment_slip')->move(base_path('public/images/deposit-slips'), $fileName1);

                $payment = 'images/deposit-slips/' . $fileName1;
            }

            $createDeposit = Deposit::create([
                'reservation_id' => $getResId,
                'deposit_img' => $payment,
                'bank' => $request->bank_name,
                'reference_no' => $request->ref_no,
                'time_deposited' => $request->time_deposited,
                'amount' => $request->amount,
                'isAcknowledged' => 0,
            ]);

            return $getResId;
        } else {
            return response('Reservation Number Not Found', 400);
        }

    }

    public function getReservationUpcoming()
    {
        $current_date = Carbon::now()->setTimezone('Singapore');

        return Reservation::with(['reservation_details' => function ($q) {
                $q->with('rooms');
            }, 'deposits'])
            ->where('is_active', 1)
            ->where('is_checked_in', 0)
            ->where('is_checked_out', 0)
            ->orderBy('is_paid', 'ASC')
            ->get();
    }

    public function getReservationOngoing()
    {
        $current_date = Carbon::now()->setTimezone('Singapore');

        return Reservation::with(['reservation_details' => function ($q) {
            $q->with('rooms');
        }, 'deposits'])
            ->where('is_checked_in', 1)
            ->where('is_checked_out', 0)
            ->get();
    }

    public function deleteReservation($request)
    {
        $delete1 = ReservationDetails::where('reservation_id', $request->selected['id'])->delete();

        return  Reservation::where('id', $request->selected['id'])->delete();
    }

    public function checkIn($request)
    {
        return Reservation::where('id', $request->id)
            ->update([
                'is_checked_in' => 1,
            ]);
    }

    public function checkOut($request)
    {
        return Reservation::where('id', $request->id)
            ->update([
                'is_checked_out' => 1,
            ]);
    }

    public function payCash($request)
    {
        $id = $request->id;
        $amount = $request->payment_cash;

        $res = Reservation::where('id', $id)->first();

        $new_amount = $amount + $res['payment'];

        $newDeposit = Deposit::create([
            'reservation_id' => $id,
            'deposit_img' => 'Cash',
            'bank' => 'Cash',
            'time_deposited' => 'Cash',
            'amount' => $amount,
            'isAcknowledged' => 1,
            'reference_no' => 'Cash',
        ]);

        if($new_amount == $res['amount']) {
            $changeResNo = $res['last_name'] . '_' . $res['reservation_no'];

            Reservation::where('id', $id)
                ->update([
                    'reservation_no' => $changeResNo,
                    'payment' => $new_amount,
                    'is_paid' => 1,
                ]);
        } else {
            Reservation::where('id', $id)
                ->update([
                    'payment' => $new_amount,
                ]);
        }
    }
}
