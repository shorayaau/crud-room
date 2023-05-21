<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
    {
        //get room
        $room = DB::table("rooms")->leftJoin('room_types','room_types.id', '=', 'rooms.room_type_id')->select("rooms.*","room_types.room_type")->get();

        //render view with room
        return view('menu/room.index', compact('room'))->with([
            'user' => Auth::user()
        ]);
    }

    public function create()
    {
        return view('menu/room.create')->with([
            'user' => Auth::user(),
            'room_type' => RoomType::all()
        ]);
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'room_type_id'     => 'required',
            'room_name'     => 'required',
            'area'   => 'required',
            'price'     => 'required',
            'facility'     => 'required',
        ]);

        // dd(floatval(str_replace(",", "", $request->price)));

        //create room
        Room::create([
            'room_type_id'     => $request->room_type_id,
            'room_name'   => $request->room_name,
            'area'   => $request->area,
            'price'   => floatval(str_replace(",", "", $request->price)),
            'facility'   => $request->facility
            // 'password'   => Hash::make($request->password)
        ]);

        //redirect to index
        return redirect()->route('room.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(Room $room)
    {
        return view('menu/room.edit', compact('room'))->with([
            'user' => Auth::user(),
            'room_type' => RoomType::all()
        ]);
    }

    public function update(Request $request, Room $room)
    {
        //validate form
        $this->validate($request, [
            'room_type_id'     => 'required',
            'room_name'     => 'required',
            'area'   => 'required',
            'price'     => 'required',
            'facility'     => 'required',
        ]);
        $room->update([
            'room_type_id'     => $request->room_type_id,
            'room_name'   => $request->room_name,
            'area'   => $request->area,
            'price'   => floatval(str_replace(",", "", $request->price)),
            'facility'   => $request->facility
            // 'password'   => Hash::make($request->password)
        ]);

        //redirect to index
        return redirect()->route('room.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Room $room)
    {

        //delete room
        $room->delete();

        //redirect to index
        return redirect()->route('room.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
