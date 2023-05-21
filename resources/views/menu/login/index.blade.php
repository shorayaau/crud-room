@extends('layouts.admin')
{{-- @section('header', 'Barang') --}}

@section('content')
    <div class="w-50 center border rounded px-3 py-3 mx-auto">
        <h1>LOGIN</h1>
        <form action="{{ url('auth/login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" value="@if (session()->has('user')) {{ Session::get('username') }} @endif" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3 d-grid">
                <button type="submit" name="submit" class="btn btn-primary">LOGIN</button>
            </div>
        </form>
    </div>
@endsection
