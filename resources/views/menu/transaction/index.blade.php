@extends('layouts.admin')
@section('header', 'Transaction')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                @if ($user->level == 'user')
                    <a href="{{ url('transaction/create') }}" class="btn btn-sm btn-primary pull-right"><i
                            class="bi bi-plus-square-dotted"></i>&nbsp; Order Room</a>
                @endif
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Cust Name</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            function rupiah($angka)
                            {
                                $hasil_rupiah = number_format($angka, 0, '.', ',');
                                return $hasil_rupiah;
                            }
                        @endphp
                        @forelse($transaction as $num => $value)
                            <tr>
                                <td>{{ $num + 1 }}</td>
                                <td>{{ $value->cust_name }}</td>
                                <td>{{ rupiah($value->final_total) }}</td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Transaction belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
@endpush
