@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <p class="error-block">{{ __('lang.not_have_access_to_task') }}</p>
        </div>
    </div>
@endsection
