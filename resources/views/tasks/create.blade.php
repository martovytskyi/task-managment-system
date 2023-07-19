@extends('layouts.app')

@section('content')
    <div class="container task-form">
        <div class="row">
            <form method="POST" action="{{ route('tasks.store') }}" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">{{ __('lang.title') }}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="title" id="title" value="{{ old('title') }}"
                                       placeholder="{{ __('lang.enter_title') }}" required>
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                @elseif (old('title') !== '')
                                    <div class="invalid-tooltip">
                                        {{ __('lang.title_required') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('lang.description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror desc"
                                          id="description" name="description"
                                          placeholder="{{ __('lang.describe_the_task') }}" required
                                          rows="5">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                @elseif (old('description') !== '')
                                    <div class="invalid-tooltip">
                                        {{ __('lang.description_task_is_required') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">{{ __('lang.status') }}</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                        id="status" required>
                                    @foreach (\App\Enums\TaskStatus::toArray() as $key => $status)
                                        <option
                                            value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                            {{ __('lang.' . strtolower($status)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="deadline">{{ __('lang.deadline') }}</label>
                                <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                                       name="deadline" id="deadline" value="{{ old('deadline') }}" required>
                                @if ($errors->has('deadline'))
                                    <div class="invalid-feedback">{{ $errors->first('deadline') }}</div>
                                @elseif (old('deadline') !== '')
                                    <div class="invalid-tooltip">
                                        {{ __('lang.select_valid_date') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">{{ __('lang.add_task') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            'use strict';
            window.addEventListener('load', () => {
                const forms = document.getElementsByClassName('needs-validation');
                for (const form of forms) {
                    form.addEventListener('submit', (event) => {
                        form.classList.add('was-validated');
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        } else {
                            const formId = form.id;
                            document.getElementById(formId).submit();
                        }
                    }, false);
                }
            }, false);
        })();
    </script>
@endsection
