@extends('layouts.app')

@section('content')
<div class="register-card">
    <div class="register-header">{{ __('Dashboard') }}</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('You are logged in!') }}
        </div>
    </div>
</div>
@endsection
