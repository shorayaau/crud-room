@extends('layouts.admin')
@section('header', 'Room Type')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Room Type</h3>
                </div>
                <form method="POST" action="{{ route('room_type.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Room Type</label>
                            <input type="text" class="form-control @error('room_type') is-invalid @enderror" name="room_type"
                                value="{{ old('room_type') }}">
                            @error('room_type')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script>
        $(document).ready(function() {
            function FormatRupiah(angka, prefix) {
                if (!angka) {
                    return '';
                }
                var vangka = angka.toString();
                var number_string = vangka.replace(/[^.\d]/g, '').replace(/[^\w\s]/gi, '').toString(),
                    split = number_string.split('.'),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? ',' : '';
                    rupiah += separator + ribuan.join(',');
                }

                rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
            };

        });
    </script>
@endpush --}}
