@extends('layouts.main')

@section('title', __('tasks.my_tasks'))

@section('content')
    <h2 class="mb-4">{{ __('tasks.my_tasks') }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>{{ __('tasks.error') }}</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-dark">
            <tr>
                <th>{{ __('tasks.number') }}</th>
                <th>{{ __('tasks.status') }}</th>
                <th>{{ __('tasks.name') }}</th>
                <th>{{ __('tasks.description') }}</th>
                <th>{{ __('tasks.created_at') }}</th>
                <th>{{ __('tasks.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $index => $task)
                @if(request('edit') == $task->id)
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <td>{{ $index + 1 }}</td>
                        <td>
                            <button type="button" class="btn btn-sm {{ $task->is_done ? 'btn-success' : 'btn-outline-secondary' }}" disabled>
                                {{ $task->is_done ? '✔' : '✗' }}
                            </button>
                        </td>
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
                            <button type="submit" class="btn btn-success btn-sm">{{ __('tasks.save') }}</button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">{{ __('tasks.cancel') }}</a>
                        </td>
                    </form>
                @else
                    <tr class="{{ $task->is_done ? 'table-success' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $task->is_done ? 'btn-success' : 'btn-outline-secondary' }}">
                                    {{ $task->is_done ? '✔' : '✗' }}
                                </button>
                            </form>
                        </td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('tasks.index', ['edit' => $task->id]) }}" class="btn btn-sm btn-warning">{{ __('tasks.edit') }}</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick={{ __('tasks.delete_task') }}>{{ __('tasks.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach

            <tr>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <td>#</td>
                    <td></td>
                    <td>
                        <input type="text" name="title" class="form-control" placeholder={{ __('tasks.add_name') }} required value="{{ old('title') }}">
                    </td>
                    <td>
                        <input type="text" name="description" class="form-control" placeholder={{ __('tasks.add_description') }} value="{{ old('description') }}">
                    </td>
                    <td>—</td>
                    <td>
                        <button type="submit" class="btn btn-success btn-sm">{{ __('tasks.add') }}</button>
                    </td>
                </form>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
