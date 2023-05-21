<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('menu/laporan.index')->with([
            'user' => Auth::user(),
            'room_type' => RoomType::all()
        ]);
    }

    public function laporanpenjualan($tglawal, $tglakhir, $type_room)
    {
        $users = User::select('*')
            ->get();
        // dd($tglawal);
        // dd($tglakhir);
        $tglawal = date('Y-m-d', strtotime($tglawal));
        $tglakhir = date('Y-m-d', strtotime($tglakhir));

        $penjualan = DB::table('transactions')
            ->leftjoin('transaction_details', 'transaction_details.trans_id', '=', 'transactions.id')
            ->leftjoin('rooms','rooms.id', '=', 'transaction_details.room_id')
            ->leftjoin('room_types','room_types.id', '=', 'rooms.room_type_id')
            ->select('transactions.*', 'transaction_details.*','rooms.*', 'room_types.*')
            ->where(DB::raw("strftime('%Y-%m-%d', 'transactions.trans_date')", [$tglawal, $tglakhir]))
            ->where('room_types.id', $type_room)
            ->get();

        $pdf = PDF::loadView('menu/laporan.laporan', ['penjualan' => $penjualan, 'users' => $users], compact('tglawal', 'tglakhir'));
        return $pdf->stream('Laporan-Data-Penjualan.pdf');
    }
}
