<?php


namespace App\Http\Repositories;

use App\Models\Deposit;
use App\Models\Reservation;
use App\Models\ReservationDetails;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class ReservationRepository
{
    public function createReservation($request)
    {
        $date_tomorrow = Carbon::now()->addDays(3)->setTimezone('Singapore');

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
        $rooms = $request->rooms;

        for($i = 0; $i < count($rooms); $i++) {
            ReservationDetails::create([
                'reservation_id' => $r->id,
                'room_id' => $rooms[$i]['id'],
                'start_date' => $request->check_in,
                'end_date' => $request->check_out,
            ]);
        }

        //Create Email
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sandbarbeachresort@gmail.com';
            $mail->Password = 'sandbar0327';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('sandbarbeachresort@gmail.com', 'Sand Bar Beach Resort');
            $mail->addAddress($request->email, $request->first_name . ' ' . $request->last_name);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Reservation in Sand Bar Beach Resort';
            $mail->Body    = 'Good day! If you received this email, then you have been successfully make a reservation to
                <b>Sand Bar Beach Resort!</b> Your reservation number is ' .  '<b>' . $reservation_no . '</b>. Your total remaining balance
                is <b>' . $request->amount . '</b>.To make a payment,you can deposit to our
                <b>BPI Account - 102035023052 - Sand Bar Beach Resort</b>. After making a deposit, be sure that you
                will visit our site to send us the picture of deposit slip.
                <br><br> Here is the steps in sending the picture of your deposit slip:
                <br>1. Visit our site at sandbarbeachresort.com
                <br>2. On upper right corner, you can see the "Check Booking". Click and navigate that.
                <br>3. Choose the Upload Payment Button and fill up necessary information and you are done!
                <br><br>Please be reminded that you will be only given 72 hours to complete your payment.
                If you have any concern, please email us at sandbarbeachresort@gmail.com or call us at 0918-449-5439. Thank you and have a nice day!';

            $mail->AltBody = 'Good day! If you received this email, then you have been successfully make a reservation to
                Sand Bar Beach Resort! Your reservation number is ' . $reservation_no . '.  Your total remaining balance
                is ' . $request->amount . '.To make a payment,you can deposit to our BPI Account - 102035023052 - Sand Bar Beach Resort.
                After making a deposit, be sure that you will visit our site to send us the picture of deposit slip.
                <br><br> Here is the steps in sending the picture of your deposit slip.
                <br>1. Visit our site at sandbarbeachresort.com
                <br>2. On upper right corner, you can see the "Check Booking". Click and navigate that.
                <br>3. Choose the Upload Payment Button and fill up necessary information and you are done!
                <br><br>Please be reminded that you will be only given 72 hours to complete your payment.
                If you have any concern, please email us at sandbarbeachresort@gmail.com or call us at 0918-449-5439. Thank you and have a nice day!';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function checkReservation($request)
    {
        $res_no = $request->res_no;
        $getResId = Reservation::where('reservation_no', $request->res_no)->pluck('id')->first();

        if($getResId != null) {
            $data['details'] = Reservation::where('reservation_no', $res_no)
                ->with(['reservation_details' => function ($query) {
                    $query->with('rooms');
                }])
                ->get()
                ->first();
        } else {
            return response('Reservation Number Not Found', 400);
        }
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
        return Reservation::with(['reservation_details' => function ($q) {
                $q->with('rooms');
            }, 'deposits'])
            ->where('is_active', 1)
            ->where('is_checked_in', 0)
            ->where('is_checked_out', 0)
            ->orderBy('is_paid', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getReservationOngoing()
    {
        return Reservation::with(['reservation_details' => function ($q) {
            $q->with('rooms');
        }, 'deposits'])
            ->where('is_checked_in', 1)
            ->where('is_checked_out', 0)
            ->get();
    }

    public function getReservationExpired()
    {
        return Reservation::with(['reservation_details' => function ($q) {
            $q->with('rooms');
        }, 'deposits'])
            ->where('is_active', 0)
            ->orderBy('created_at', 'DESC')
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

            return Reservation::where('id', $id)
                ->update([
                    'reservation_no' => $changeResNo,
                    'payment' => $new_amount,
                    'is_paid' => 1,
                ]);
        } else {
            return Reservation::where('id', $id)
                ->update([
                    'payment' => $new_amount,
                ]);
        }
    }

    public function checkExpiredReservation($request)
    {
        $expired = Reservation::where('expiry_date', '<=', $request->datetime)
            ->where('is_active', 1)
            ->where('is_paid', 0)
            ->get();

        for($i = 0; $i < count($expired); $i++) {
            Reservation::where('id', $expired[$i]['id'])
                ->update(['is_active' => 0]);
        }
    }
}
