<?php


namespace App\Http\Repositories;

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
        $reservation_no = rand(1111111111,9999999999);

        $r = new Reservation;
        $r->reservation_no = $reservation_no;
        $r->name = $request->name;
        $r->email = $request->email;
        $r->contact_no = $request->contact_no;
        $r->requests = $request->requests;
        $r->amount = $request->amount;
        $r->guest_no = $request->guest_no;
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
        /*dd($request->all());*/
        try {
            $payment = null;

            if ($request->file('payment_slip') != null) {
                $file = $request->file('payment_slip');

                $fileName1 = $file->getClientOriginalName();

                $request->file('payment_slip')->move(base_path('public/images/deposit-slips'), $fileName1);

                $payment = 'public/images/deposit-slips/' . $fileName1;
            }

            $update = Reservation::where('reservation_no', $request->res_no)
                ->update([
                    'bank' => $request->bank_name,
                    'time_deposited' => $request->time_deposited,
                    'deposit_img' => $payment
                ]);


        } catch (Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }
    }
}
