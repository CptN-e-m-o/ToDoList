@extends('layouts.main')

@section('title', Lang::get('menu.main_page'))

@section('content')
<div class="container mt-4">
    <h1>{{ Lang::get('menu.to_do_list') }}</h1>
</div>
@auth
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Добро пожаловать, {{ Auth::user()->name }}!</h2>
    </div>
@endauth
@endsection
