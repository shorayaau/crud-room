<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {
        return view('dashboard')->with([
            'user' => Auth::user()
        ]);;
    }

    public function chart()
    {
        // dd($tahun);
        $users = User::select('*')
            ->get();
        $query = "SELECT
        CASE
        WHEN hasil.bulan = '01' THEN 'JAN'
        WHEN hasil.bulan = '02' THEN 'FEB'
        WHEN hasil.bulan = '03' THEN 'MAR'
        WHEN hasil.bulan = '04' THEN 'APR'
        WHEN hasil.bulan = '05' THEN 'MEI'
        WHEN hasil.bulan = '06' THEN 'JUN'
        WHEN hasil.bulan = '07' THEN 'JUL'
        WHEN hasil.bulan = '08' THEN 'AGS'
        WHEN hasil.bulan = '09' THEN 'SEP'
        WHEN hasil.bulan = '10' THEN 'OKT'
        WHEN hasil.bulan = '11' THEN 'NOV'
        ELSE 'DES' END AS bulan,
        COALESCE(SUM(s.total_room_price),0) AS total_room,
        COALESCE(SUM(s.total_extra_charge),0) AS total_charge,
        COALESCE(SUM(s.final_total),0) AS final_total
    FROM(
        SELECT
                '01' AS bulan
            UNION ALL
            SELECT
                '02'
            UNION ALL
            SELECT
                '03'
            UNION ALL
            SELECT
                '04'
            UNION ALL
            SELECT
                '05'
            UNION ALL
            SELECT
                '06'
            UNION ALL
            SELECT
                '07'
            UNION ALL
            SELECT
                '08'
            UNION ALL
            SELECT
                '09'
            UNION ALL
            SELECT
                '10'
            UNION ALL
            SELECT
                '11'
            UNION ALL
            SELECT
                '12'
        ) hasil
        LEFT JOIN transactions s ON strftime('%m',s.created_at) = hasil.bulan AND strftime('%Y',s.created_at) = '2023'
        LEFT JOIN transaction_details sd ON sd.trans_id = s.id
        LEFT JOIN rooms rooms ON rooms.id = sd.room_id
        LEFT JOIN room_types tr ON tr.id = rooms.room_type_id
    GROUP BY
        hasil.bulan,
        tr.room_type";
        $chart = DB::select($query);

        // $result = array();
        // dd($chart);

        // foreach ($chart as $key => $value) {
        //     $result[] = ['Bulan' => (int)$value->bulan, 'Total' => (int)$value->total];
        // }

        // echo json_encode($chart);
        return view('dashboard')
            ->with([
                'user' => Auth::user(),
                'chart' => $chart
            ]);
    }
}
