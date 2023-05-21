@extends('layouts.admin')
@section('header', 'Order Room')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Order Room</h3>
                </div>
                <form method="POST" action="{{ route('transaction.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Trans Code</label>
                                <input type="text" class="form-control @error('trans_code') is-invalid @enderror"
                                    name="trans_code" value="{{ $user->trans_code }}">
                                @error('trans_code')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Trans Date</label>
                                <input type="date" class="form-control @error('trans_date') is-invalid @enderror"
                                    name="trans_date" value="{{ date('Y-m-d') }}">
                                @error('trans_date')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Nama Cust</label>
                                <input type="text" class="form-control @error('cust_name') is-invalid @enderror"
                                    name="cust_name" value="{{ $user->cust_name }}">
                                @error('cust_name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Room</label>
                                <select name="room_id" class="form-control @error('room_id') is-invalid @enderror"
                                    id="room_id">
                                    <option value="">Pilih Room</option>
                                    @foreach ($room as $value)
                                        <option value="{{ $value->id }}" data-harga="{{ $value->price }}">
                                            {{ $value->room_name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="harga_room">
                                @error('room_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Days</label>
                                <input type="text" class="form-control @error('days') is-invalid @enderror"
                                    name="days" value="{{ $user->days }}" id="days">
                                @error('days')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>Extra Charge</label>
                                <select name="extra_charge" class="form-control @error('extra_charge') is-invalid @enderror"
                                    id="extra_charge">
                                    <option value="">Pilih Extra Charge</option>
                                    <option value="1">Minuman Soda(Rp. 20.000)</option>
                                    <option value="2">Air Putih(Rp. 15.000)</option>
                                    <option value="3">Jasa Laundry(Rp. 100.000)</option>
                                    <option value="4">Snack(Rp. 25.000)</option>
                                </select>
                                <input type="hidden" id="harga">
                                @error('room')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Jumlah Extra Charge</label>
                                <input type="text" class="form-control @error('jumlah') is-invalid @enderror"
                                    name="jumlah" id="jumlah" value="{{ $user->jumlah }}">
                                @error('jumlah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Total Room Price</label>
                            <input type="text" class="form-control @error('total_room_price') is-invalid @enderror"
                                name="total_room_price" value="{{ $user->total_room_price }}" >
                            @error('total_room_price')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Total Extra Charge</label>
                            <input type="text" class="form-control @error('total_extra_charge') is-invalid @enderror"
                                name="total_extra_charge" value="{{ $user->total_extra_charge }}">
                            @error('total_extra_charge')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Final Total</label>
                            <input type="text" class="form-control @error('final_total') is-invalid @enderror"
                                name="final_total" value="{{ $user->final_total }}">
                            @error('final_total')
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

            $("input[name='jumlah']").keyup(function() {
                $(this).val(FormatRupiah($(this).val()));
            })

            $("input[name='total_room_price']").keyup(function() {
                $(this).val(FormatRupiah($(this).val()));
            })

            $("input[name='total_extra_charge']").keyup(function() {
                $(this).val(FormatRupiah($(this).val()));
            })

            $("input[name='final_total']").keyup(function() {
                $(this).val(FormatRupiah($(this).val()));
            })

            function DeFormatRupiah(angka) {
                var result = angka.replace(/,/g, '');
                return result;
            };

            $(document).on('change', '#room_id', function() {
                // var tr = $(this).parent().parent();
                const selected = $(this).find('option:selected');
                const nb = selected.data('harga');
                // console.log(nb);
                // var i = $(this).data('index');

                $("input[name='total_room_price']").val(FormatRupiah(nb));
                $("#harga_room").val(FormatRupiah(nb));

                var total_room_price = parseFloat(DeFormatRupiah($(this).val()));
                var harga = parseFloat(DeFormatRupiah($('#harga').val()));
                var days = parseFloat(DeFormatRupiah($("input[name='days']").val()));
                console.log(harga);
                if (harga == 0 || harga == '' || harga == NaN || days == NaN) {
                    $("input[name='final_total']").val(FormatRupiah(total_room_price * days));
                } else {
                    $("input[name='final_total']").val(FormatRupiah((total_room_price * days) * harga));
                }
                // console.log(harga_extra);
                // $(".harga_satuan").eq(i).val(nb);
            });

            $('#days').keyup(function() {
                $(this).val(FormatRupiah($(this).val()));
                var qty = parseFloat(DeFormatRupiah($(this).val()));
                var harga_extra = parseFloat(DeFormatRupiah($("#harga_room").val()));
                // console.log(harga_extra);
                $("input[name='total_room_price']").val(FormatRupiah(qty * harga_extra));
                $("input[name='final_total']").val(FormatRupiah((qty * harga_extra)));
            })

            $(document).on('change', '#extra_charge', function() {
                // var harga_extra = 0;
                if ($(this).val() == '1') {
                    $("#harga").val(FormatRupiah(20000));

                } else if ($(this).val() == '2') {
                    $("#harga").val(FormatRupiah(15000));

                } else if ($(this).val() == '3') {
                    $("#harga").val(FormatRupiah(100000));

                } else if ($(this).val() == '4') {
                    $("#harga").val(FormatRupiah(25000));

                } else {
                    $("#harga").val(FormatRupiah(0));
                }
                var qty = parseFloat(DeFormatRupiah($('#jumlah').val()));
                var harga_extra = parseFloat(DeFormatRupiah($('#harga').val()));
                var total_room_price = parseFloat(DeFormatRupiah($("input[name='total_room_price']")
                    .val()));
                // console.log(harga_extra);
                $("input[name='total_extra_charge']").val(FormatRupiah(qty * harga_extra));
                $("input[name='final_total']").val(FormatRupiah((qty * harga_extra) + total_room_price));
                // $(".harga_satuan").eq(i).val(nb);
            });

            $('#jumlah').keyup(function() {
                $(this).val(FormatRupiah($(this).val()));
                var qty = parseFloat(DeFormatRupiah($(this).val()));
                var harga_extra = parseFloat(DeFormatRupiah($("#harga").val()));
                var total_room_price = parseFloat(DeFormatRupiah($("input[name='total_room_price']")
                    .val()));
                // console.log(harga_extra);
                $("input[name='total_extra_charge']").val(FormatRupiah(qty * harga_extra));
                $("input[name='final_total']").val(FormatRupiah((qty * harga_extra) + total_room_price));
            })
        });
    </script>
@endpush
