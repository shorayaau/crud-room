@extends('layouts.admin')
@section('header', 'Room')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Room</h3>
                </div>
                <form method="POST" action="{{ route('room.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Room Type</label>
                            <select name="room_type_id" class="form-control @error('room_type_id') is-invalid @enderror"
                                id="room_type_id">
                                <option value="">Pilih Room Type</option>
                                @foreach ($room_type as $value)
                                    <option value="{{ $value->id }}">
                                        {{ $value->room_type }}</option>
                                @endforeach
                            </select>
                            @error('room_type_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Room</label>
                            <input type="text" class="form-control @error('room_name') is-invalid @enderror" name="room_name"
                                value="{{ old('room_name') }}">
                            @error('room_name')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Area</label>
                            <input type="text" class="form-control @error('area') is-invalid @enderror"
                                name="area" value="{{ old('area') }}">
                            @error('area')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                name="price" id="price" value="{{ old('price') }}">
                            @error('price')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Facility</label>
                            <input type="text" class="form-control @error('facility') is-invalid @enderror"
                                name="facility" value="{{ old('facility') }}">
                            @error('facility')
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

@push('js')
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

            $('#price').keyup(function() {
                $(this).val(FormatRupiah($(this).val()));
            })
        });
    </script>
@endpush
