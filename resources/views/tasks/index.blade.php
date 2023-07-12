@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row tasks">
            <div class="col-24">
                <div class="count-tasks">{{ __('lang.total_tasks') }}: <span class="number">{{ count($tasks) }}</span></div>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary create">{{ __('lang.create_task') }}</a>
            </div>
            <div class="col">
                <h3 class="bg-warning task-title">{{ __('lang.not_started') }}
                    <span class="status-count">({{ count($tasks->where('status', \App\Models\Task::NOT_STARTED)) }})</span>
                </h3>
                @foreach ($tasks->where('status', \App\Models\Task::NOT_STARTED) as $task)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">{{ mb_strimwidth($task->title, 0, 24, "...") }}</h3>
                            <p class="card-text desc">{{ mb_strimwidth($task->description, 0, 64, "...") }}</p>
                            <p class="card-text">{{ __('lang.deadline') }}: {{ $task->deadline }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">{{ __('lang.edit') }}</a>
                            <form method="POST" action="{{ route('tasks.remove', $task) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('lang.remove') }}</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col">
                <h3 class="bg-info task-title">{{ __('lang.in_progress') }}
                    <span class="status-count">({{ count($tasks->where('status', \App\Models\Task::IN_PROGRESS)) }})</span>
                </h3>
                @foreach ($tasks->where('status', \App\Models\Task::IN_PROGRESS) as $task)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">{{ mb_strimwidth($task->title, 0, 24, "...") }}</h3>
                            <p class="card-text desc">{{ mb_strimwidth($task->description, 0, 64, "...") }}</p>
                            <p class="card-text">{{ __('lang.deadline') }}: {{ $task->deadline }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">{{ __('lang.edit') }}</a>
                            <form method="POST" action="{{ route('tasks.remove', $task) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('lang.remove') }}</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col">
                <h3 class="bg-success task-title">{{ __('lang.completed') }}
                    <span class="status-count">({{ count($tasks->where('status', \App\Models\Task::COMPLETED)) }})</span>
                </h3>
                @foreach ($tasks->where('status', \App\Models\Task::COMPLETED) as $task)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">{{ mb_strimwidth($task->title, 0, 24, "...") }}</h3>
                            <p class="card-text desc">{{ mb_strimwidth($task->description, 0, 64, "...") }}</p>
                            <p class="card-text">{{ __('lang.deadline') }}: {{ $task->deadline }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">{{ __('lang.edit') }}</a>
                            <form method="POST" action="{{ route('tasks.remove', $task) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('lang.remove') }}</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
