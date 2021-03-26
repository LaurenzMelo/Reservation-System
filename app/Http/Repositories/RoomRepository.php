<?php


namespace App\Http\Repositories;

use App\Models\Room;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class RoomRepository
{
    public function getRooms()
    {
        return Room::all();
    }

    public function getRoomsWebsite()
    {
        return Room::all();
    }

    public function getVacantRooms($request)
    {
        $check_in = Carbon::parse($request->check_date['start'])->addDay()->startOfDay()->addHours(14);
        $check_out = Carbon::parse($request->check_date['end'])->addDay()->startOfDay()->addHours(12);
        $rooms = $request->rooms_no;
        $guests = $request->guests_no;
        /*dd($check_in . ' - ' . $check_out);*/

        /*$data['vacant_rooms'] = Room::whereHas('reservation_details', function (Builder $query) use ($check_in, $check_out, $guests) {
            $query->whereHas('reservation', function (Builder $q) use ($check_in, $check_out, $guests) {
                $q->whereNotBetween('start_date', [$check_in, $check_out])
                    ->orWhereNotBetween('end_date', [$check_in, $check_out]);
            })->with('reservation');
        })
            ->with('reservation_details')
            ->where('capacity', '>=', $guests)
            ->get();*/

        $data['vacant_rooms'] = Room::whereDoesntHave('reservation_details', function (Builder $query) use ($check_in, $check_out) {
            $query->whereBetween('start_date', [$check_in, $check_out])
                ->orWhereBetween('end_date', [$check_in, $check_out]);
        })
            ->with('reservation_details')
            ->orderBy('capacity', 'ASC')
            ->get();

        return response()->json($data);


    }
}
