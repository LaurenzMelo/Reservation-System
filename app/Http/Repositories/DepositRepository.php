<?php


namespace App\Http\Repositories;

use App\Models\Deposit;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class DepositRepository
{
    public function getDeposit()
    {
        return Deposit::with(['reservation' => function ($query) {
            $query->with(['reservation_details' => function ($q) {
                $q->with('rooms');
            }]);
        }])
            ->where('isAcknowledged', 0)
            ->where('isActive', 1)
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public function getApprovedDeposit()
    {
        return Deposit::with('reservation')
            ->where('isAcknowledged', 1)
            ->where('isActive', 1)
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public function getDisapprovedDeposit()
    {
        return Deposit::with('reservation')
            ->where('isActive', 0)
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public function approvePayment($request)
    {
        $amount = $request->selected['amount'];

        Deposit::where('id', $request->selected['id'])
            ->update([
                'isAcknowledged' => 1,
            ]);

        $res = Reservation::where('id', $request->selected['reservation_id'])->first();

        $amount += $res['payment'];

        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sandbarbeachresort@gmail.com';
        $mail->Password = 'Sand_bar03_27';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('sandbarbeachresort@gmail.com', 'Sand Bar Beach Resort');
        $mail->addAddress($res['email'], $res['first_name'] . ' ' . $res['last_name']);

        if($amount == $res['amount']) {
            $changeResNo = $res['last_name'] . '_' . $res['reservation_no'];

            Reservation::where('id', $request->selected['reservation_id'])
                ->update([
                    'reservation_no' => $changeResNo,
                    'payment' => $amount,
                    'is_paid' => 1,
                ]);

            try {
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Payment Success - Sand Bar Beach Resort';
                $mail->Body    = 'Your Deposit Slip with reference number of <b>' . $request->selected['reference_no'] . '</b> is now approved!
                    Your payment is now complete. Your new booking number is <b>' . $changeResNo . '</b>. Please be reminded that the check in on the resort is at exactly 2:00 pm on the
                    day of your reservation.
                    <br><br> If you have any concern, please email us at sandbarbeachresort@gmail.com or call us at 0918-449-5439.
                    Once Again, Thank you for choosing Sand Bar Beach Resort!';

                $mail->AltBody = 'Your Deposit Slip with reference number of ' . $request->selected['reference_no'] . ' is approved!
                    Your payment is now complete. Your new booking number is ' . $changeResNo . '. Please be reminded that the check in on the resort is at exactly 2:00 pm on the
                    day of your reservation. If you have any concern, please email us at sandbarbeachresort@gmail.com or call us at 0918-449-5439.
                    Once Again, Thank you for choosing Sand Bar Beach Resort!';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            Reservation::where('id', $request->selected['reservation_id'])
                ->update([
                    'payment' => $amount,
                ]);

            try {
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Payment Success - Sand Bar Beach Resort';
                $mail->Body    = 'Your Deposit Slip with reference number of <b>' . $request->selected['reference_no'] . '</b> is now approved!
                    However, your payment is not yet complete. Please be reminded that the check in on the resort is at exactly 2:00 pm on the day of your reservation.
                    <br><br> If you have any concern, please email us at sandbarbeachresort@gmail.com or call us at 0918-449-5439.
                    Once Again, Thank you for choosing Sand Bar Beach Resort!';

                $mail->AltBody = 'Your Deposit Slip with reference number of ' . $request->selected['reference_no'] . ' is approved!
                    However, your payment is not yet complete. Please be reminded that the check in on the resort is at exactly 2:00 pm on the
                    day of your reservation. If you have any concern, please email us at sandbarbeachresort@gmail.com or call us at 0918-449-5439.
                    Once Again, Thank you for choosing Sand Bar Beach Resort!';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }

    public function disapprovePayment($request)
    {
        $res = Reservation::where('id', $request->selected['reservation_id'])->first();
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sandbarbeachresort@gmail.com';
            $mail->Password = 'Sand_bar03_27';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('sandbarbeachresort@gmail.com', 'Sand Bar Beach Resort');
            $mail->addAddress($res['email'], $res['first_name'] . ' ' . $res['last_name']);     //Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Payment Failed - Sand Bar Beach Resort';
            $mail->Body    = 'Your Deposit Slip with reference number of <b>' . $request->selected['reference_no'] . '</b> has been disapproved. If
                you think this is a mistake, please email us at sandbarbeachresort@gmail.com or call us 0918-449-5439 for faster response.';

            $mail->AltBody = 'Your Deposit Slip with reference number of ' . $request->selected['reference_no'] . ' has been disapproved. If
                you think this is a mistake, please email us at sandbarbeachresort@gmail.com or call us 0918-449-5439 for faster response.';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return Deposit::where('id', $request->selected['id'])
            ->update([
                'isActive' => 0,
            ]);
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
            $reservation_no = str_ireplace($res['last_name'] .'_', '', $res['reservation_no']);
            Reservation::where('id', $request->selected['reservation_id'])
                ->update([
                    'payment' => $amount,
                    'is_paid' => 0,
                    'reservation_no' => $reservation_no,
                ]);
        } else {
            Reservation::where('id', $request->selected['reservation_id'])
                ->update([
                    'payment' => $amount,
                ]);
        }
    }

    public function revertDisapprove($request)
    {
        return Deposit::where('id', $request->selected['id'])
            ->update([
                'isActive' => 1
            ]);
    }

    public function asPeso($value) {
        return '₱' . number_format($value, 2);
    }
}
