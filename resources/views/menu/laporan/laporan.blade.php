<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Penjualan</title>
</head>

<body>
    <div style="text-align: center;">
        <font size="5"><b>LAPORAN DATA PENJUALAN</b></font><br>
    </div>

    <br>
    <div class="w-50 float-left mt-10">
    </div>
    <div style="clear: both;"></div>
    <br>
    <h4>Header</h4>
    <table border="1" cellspacing="0" width="100%">
        <thead style="background-color: #f5b2bb; text-align: center;">
            <tr>
                <th>No</th>
                <th>Trans Code</th>
                <th>Trans Date</th>
                <th>Cust Name</th>
                <th>Total Room Price</th>
                <th>Total Extra Charge</th>
                <th>Final Total</th>

                @php
                    // $total_akhir = 0;
                    $no = 1;
                @endphp
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $t)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $t->trans_code }}</td>
                    <td>{{ $t->trans_date }}</td>
                    <td>{{ $t->cust_name }}</td>
                    <td>@currency($t->total_room_price)</td>
                    <td>@currency($t->total_extra_charge)</td>
                    <td>@currency($t->final_total)</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Detail</h4>
    <table border="1" cellspacing="0" width="100%">
        <thead style="background-color: #f5b2bb; text-align: center;">
            <tr>
                <th>No</th>
                <th>Trans Code</th>
                <th>Room</th>
                <th>Days</th>
                <th>SubTotal Room</th>
                <th>Extra Charge</th>

                @php
                    // $total_akhir = 0;
                    $no = 1;
                @endphp
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $t)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $t->trans_code }}</td>
                    <td>{{ $t->room_name }}</td>
                    <td>{{ $t->days }}</td>
                    <td>@currency($t->subtotal_rooms)</td>
                    <td>@currency($t->extra_charge)</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
