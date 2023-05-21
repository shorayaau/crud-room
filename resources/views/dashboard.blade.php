@extends('layouts.admin')

@section('content')
    CRUD - ROOM
    <div id="linechart" style="width: 900px; height: 500px"></div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {{-- <script type="text/javascript" src="https://www.google.com/jsapi"></script> --}}
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Set Data
            var data = google.visualization.arrayToDataTable([
                ['Bulan', 'Total Room Price', 'Total Extra Charge', 'Final Total'],

                @php
                    foreach ($chart as $d) {
                        echo "['" . $d->bulan . "'," . $d->total_room . ',' . $d->total_charge . ', ' . $d->final_total . "],";
                    }
                @endphp
            ]);
            // Set Options
            var options = {
                title: 'Total Penjualan',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };
            // Draw
            var chart = new google.visualization.LineChart(document.getElementById('linechart'));

            chart.draw(data, options);
        }
    </script>
@endsection
