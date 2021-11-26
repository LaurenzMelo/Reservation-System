<?php


namespace App\Http\Repositories;

use App\Models\ReservationDetails;
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
        return Room::orderBy('capacity', 'ASC')->get();
    }

    public function getVacantRooms($request)
    {
        $check_in = Carbon::parse($request->check_date['start'])->addDay()->startOfDay()->addHours(14);
        $check_out = Carbon::parse($request->check_date['end'])->addDay()->startOfDay()->addHours(12);
        $rooms = $request->rooms_no;
        $guests = $request->guests_no;

        $data['vacant_rooms'] = Room::whereDoesntHave('reservation_details', function (Builder $query) use ($check_in, $check_out) {
            $query->whereBetween('start_date', [$check_in, $check_out])
                ->orWhereBetween('end_date', [$check_in, $check_out]);
        })
            ->with('reservation_details')
            ->orderBy('capacity', 'ASC')
            ->get();

        return response()->json($data);
    }

    public function getVacantRoomsChange($request)
    {
        $check_in = $request->check_in;
        $check_out = $request->check_out;

        $data['vacant_rooms'] = Room::whereDoesntHave('reservation_details', function (Builder $query) use ($check_in, $check_out) {
            $query->whereBetween('start_date', [$check_in, $check_out])
                ->orWhereBetween('end_date', [$check_in, $check_out]);
        })
            ->with('reservation_details')
            ->orderBy('capacity', 'ASC')
            ->get();

        return response()->json($data);
    }

    public function addRooms($request)
    {
        $room_img_file = null;

        if ($request->file('room_img') != null) {
            $file = $request->file('room_img');
            $fileName1 = $file->getClientOriginalName();
            $request->file('room_img')->move(base_path('public/images/rooms'), $fileName1);
            $room_img_file = 'images/rooms/' . $fileName1;
        }

        $create = Room::create([
            'name' => $request->name,
            'description' => $request->desc,
            'amount' => $request->amount,
            'capacity' => $request->capacity,
            'amenities' => '[' . json_encode($request->amenities) . ']',
            'image' => $room_img_file,
            'capacity_extend' => '2',
        ]);
    }

    public function editRooms($request)
    {
        $edit_room_img_file = null;

        if ($request->file('room_img') != null) {
            $file = $request->file('room_img');
            $fileName1 = $file->getClientOriginalName();
            $request->file('room_img')->move(base_path('public/images/rooms'), $fileName1);
            $edit_room_img_file = 'images/rooms/' . $fileName1;

            $edit= Room::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'description' => $request->desc,
                'amount' => $request->amount,
                'capacity' => $request->capacity,
                'amenities' => '[' . json_encode($request->amenities) . ']',
                'image' => $edit_room_img_file,
                'capacity_extend' => '2',
            ]);
        } else {
            $edit= Room::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->desc,
                    'amount' => $request->amount,
                    'capacity' => $request->capacity,
                    'amenities' => '[' . json_encode($request->amenities) . ']',
                    'capacity_extend' => '2',
                ]);
        }
    }

    public function deleteRooms($id)
    {
        $findRoom = ReservationDetails::where('room_id', $id)->get();

        if(count($findRoom) >= 1) {
            return Room::where('id', $id)->delete();
        } else {
            return response('Room has reservation', 400);
        }


    }
}
