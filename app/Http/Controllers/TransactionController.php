<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Item;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    function index()
    {
        //get transaction

        $user = Auth::user();
        // if ($user->level == 'pembeli') {
        //     $transaction = DB::table('transaction')
        //         ->join('items', 'items.id', '=', 'transaction.id_barang')
        //         ->select('transaction.*', 'items.nama as nama_barang')->whereIn('id_user', array($user->id))
        //         ->get();
        //     // $transaction = Sales::latest()->whereIn('id_user', array($user->id))->paginate(5);
        //     // dd($transaction);
        // } else {
        //     $transaction = DB::table('transaction')
        //         ->join('items', 'items.id', '=', 'transaction.id_barang')
        //         ->select('transaction.*', 'items.nama as nama_barang', 'items.stok')
        //         ->get();
        //     }
        $transaction = Transaction::latest()->paginate(5);

        //render view with transaction
        return view('menu/transaction.index', compact('transaction'))->with([
            'user' => Auth::user()
        ]);
    }

    public function create()
    {
        return view('menu/transaction.create')->with([
            'user' => Auth::user(),
            'room' => Room::all()
        ]);
    }

    public function store(Request $request)
    {
        //validate form
        // $this->validate($request, [
        //     'trans_code' => 'required',
        //     'trans_date' => 'required',
        //     'cust_name' => 'required',
        //     'total_room_price' => 'required',
        //     'total_extra_charge' => 'required',
        //     'final_total' => 'required',
        //     'trans_id' => 'required',
        //     'room_id' => 'required',
        //     'days' => 'required',
        //     'subtotal_rooms' => 'required',
        //     'extra_charge' => 'required',
        // ]);
        // $user = Auth::user();
        // $item = Item::all()->whereIn('id', array($request->id_barang));

        // dd($request);

        //create item
        $Transaction = Transaction::create([
            'trans_code'     => $request->trans_code,
            'trans_date'     => $request->trans_date,
            'cust_name'     => $request->cust_name,
            // 'nama_barang'     => $item->nama,
            'total_room_price'   => floatval(str_replace(",", "", $request->total_room_price)),
            'total_extra_charge'   => floatval(str_replace(",", "", $request->total_extra_charge)),
            'final_total'   => floatval(str_replace(",", "", $request->final_total))
            // 'password'   => Hash::make($request->password)
        ]);

        TransactionDetail::create([
            'trans_id'     => $Transaction->id,
            'room_id'     => $request->room_id,
            'days'     => $request->days,
            // 'nama_barang'     => $item->nama,
            'subtotal_rooms'   => floatval(str_replace(",", "", $request->total_room_price)),
            'extra_charge'   => floatval(str_replace(",", "", $request->total_extra_charge)),
            // 'password'   => Hash::make($request->password)
        ]);

        //redirect to index
        return redirect()->route('transaction.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
}
