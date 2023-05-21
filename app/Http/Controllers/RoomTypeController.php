<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get room_type
        $room_type = RoomType::latest()->paginate(5);

        //render view with room_type
        return view('menu/room_type.index', compact('room_type'))->with([
            'user' => Auth::user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu/room_type.create')->with([
            'user' => Auth::user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'room_type'     => 'required'
        ]);

        // dd($request);
        //create room_type
        RoomType::create([
            'room_type'     => $request->room_type,
            // 'password'   => Hash::make($request->password)
        ]);

        //redirect to index
        return redirect()->route('room_type.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $room_type)
    {
        return view('menu/room_type.edit', compact('room_type'))->with([
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomType $room_type)
    {
        //validate form
        $this->validate($request, [
            'room_type'     => 'required',
        ]);
        $room_type->update([
            'room_type'     => $request->room_type,
            // 'password'   => Hash::make($request->password)
        ]);


        //redirect to index
        return redirect()->route('room_type.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomType $room_type)
    {
        //delete image
        // Storage::delete('public/room_type/' . $room_type->image);

        //delete room_type
        $room_type->delete();

        //redirect to index
        return redirect()->route('room_type.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
