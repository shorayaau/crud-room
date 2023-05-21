@extends('layouts.admin')
@section('header', 'Room')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <a href="{{ url('room/create') }}" class="btn btn-sm btn-primary pull-right"><i
                        class="bi bi-plus-square-dotted"></i>&nbsp; Tambah Room</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Type Room</th>
                            <th>Nama Room</th>
                            <th>Area</th>
                            <th>Price</th>
                            <th>Facility</th>
                            <th class="text-center">Action</th>
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
                        @forelse($room as $num => $value)
                            <tr>
                                <td>{{ $num + 1 }}</td>
                                <td>{{ $value->room_type }}</td>
                                <td>{{ $value->room_name }}</td>
                                <td>{{ $value->area }}</td>
                                <td>{{ rupiah($value->price) }}</td>
                                <td>{{ $value->facility }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('room.destroy', $value->id) }}" method="POST">
                                        <a href="{{ route('room.edit', $value->id) }}"
                                            class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Room belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
                {{-- {{ $room->links() }} --}}
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
