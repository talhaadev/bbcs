@extends('layouts.app')

@section('content')
<div class="register-card">
    <div class="register-header">{{ __('Reset Password') }}</div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div> --}}
        <div class="mb-3">
            <label for="phone_number" class="form-label">{{ __('Phone Number') }}</label>
            <input id="phone_number" type="number"
                   class="form-control @error('phone_number') is-invalid @enderror"
                   name="phone_number" value="{{ old('phone_number') }}" required autofocus>

            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('Send Password Reset Link') }}
        </button>
    </form>
</div>

@endsection
