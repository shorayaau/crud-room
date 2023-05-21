@extends('layouts.admin')
@section('header', 'Laporan')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-body p-0">
                <section class="content">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-table"></i> Laporan Penjualan
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="label">Tanggal Awal</label>
                                    <input type="date" name="tglawal" id="tglawal" class="form-control"><br>
                                </div>
                                <div class="col-md-4">
                                    <label for="label">Tanggal Akhir</label>
                                    <input type="date" name="tglakhir" id="tglakhir" class="form-control">

                                </div>
                                <div class="col-md-4">
                                    <label for="label">Type Room</label>
                                    <select name="room_type_id" class="form-control" id="room_type_id">
                                        <option value="">Pilih Room Type</option>
                                        @foreach ($room_type as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->room_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <a href="#"
                                        onclick="this.href='/laporan/penjualan/cetak/'+document.getElementById('tglawal').value +
                                '/' + document.getElementById('tglakhir').value + '/'+document.getElementById('room_type_id').value"
                                        target="_blank" class="btn btn-primary">
                                        <i class="fa fa-print"></i>Cetak</a>
                                </div>
                            </div>
                        </div>
                </section>
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
