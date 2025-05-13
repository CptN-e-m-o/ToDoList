@extends('layouts.main')

@section('title', Lang::get('tasks.create_task'))

@section('content')
    <h2>Создание новой задачи</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Исправьте ошибки:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Название задачи</label>
            <input type="text" name="title" class="form-control" value="" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Создать</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
