@extends('layouts.main')

@section('title', 'Регистрация')

@section('content')
    <h2 class="mb-4">{{ __('auth.registration') }}</h2>

    <form method="POST" action="#">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('auth.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('auth.email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="" required>
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

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('auth.confirm_password') }}</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('auth.register') }}</button>
    </form>
@endsection
