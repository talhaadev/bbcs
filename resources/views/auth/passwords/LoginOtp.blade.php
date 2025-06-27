@extends('layouts.app')

@section('content')
<div class="register-card">
    <div class="register-header">{{ __('Send Otp') }}</div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Otp') }}</label>
            <input id="email" type="number"
                   class="form-control @error('email') is-invalid @enderror"
                   name="otp" value="{{ old('email') }}" required autofocus>

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">
            {{ __('submit') }}
        </button>
    </form>
</div>

@endsection
