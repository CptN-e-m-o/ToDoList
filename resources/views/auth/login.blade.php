@extends('layouts.main')

@section('title', 'Авторизация')

@section('content')
    <h2 class="mb-4">{{ __('auth.authorization') }}</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf


        <div class="mb-3">
            <label for="email" class="form-label">{{ __('auth.email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('auth.password') }}</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('auth.login') }}</button>
    </form>
@endsection
