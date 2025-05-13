@extends('layouts.main')

@section('title', Lang::get('tasks.my_tasks'))

@section('content')
    <h2 class="mb-4">{{ Lang::get('tasks.my_tasks') }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ошибка:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $editId = request('edit');
    @endphp

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-dark">
            <tr>
                <th>{{ Lang::get('tasks.number') }}</th>
                <th>{{ Lang::get('tasks.name') }}</th>
                <th>{{ Lang::get('tasks.description') }}</th>
                <th>{{ Lang::get('tasks.created_at') }}</th>
                <th>{{ Lang::get('tasks.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $index => $task)
                @if($editId == $task->id)
                    <tr>
                        <form action="{{ route('tasks.update', $task) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <input type="text" name="title" class="form-control"
                                       value="{{ old('title', $task->title) }}" required>
                            </td>
                            <td>
                                <input type="text" name="description" class="form-control"
                                       value="{{ old('description', $task->description) }}">
                            </td>
                            <td>{{ $task->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <button type="submit" class="btn btn-success btn-sm">Сохранить</button>
                                <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">Отмена</a>
                            </td>
                        </form>
                    </tr>
                @else
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('tasks.index', ['edit' => $task->id]) }}" class="btn btn-sm btn-warning">Редактировать</a>
                            <form action="#" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить задачу?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach

            <tr>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <td>#</td>
                    <td>
                        <input type="text" name="title" class="form-control" placeholder="Введите название" required value="{{ old('title') }}">
                    </td>
                    <td>
                        <input type="text" name="description" class="form-control" placeholder="Введите описание" value="{{ old('description') }}">
                    </td>
                    <td>—</td>
                    <td>
                        <button type="submit" class="btn btn-success btn-sm">Добавить</button>
                    </td>
                </form>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
