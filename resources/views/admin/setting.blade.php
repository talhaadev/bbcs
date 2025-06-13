@extends('layouts.admin')
@section('title', 'Settings')
@section('content')
<style>
    .input-group-text {
        padding: 0.75rem 0.75rem !important;
    }

    textarea {
        resize: none;
    }

    /* For WebKit browsers (Chrome, Safari) */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* For Firefox */
    input[type="number"] {
        -moz-appearance: textfield;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 41px;
        height: 16px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 13px;
        width: 13px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 17px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .input-group-text {
        padding: 0.75rem 0.75rem !important;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-secondary p-3 text-white mb-2"
            style="color: white !important">
            <h4 class="mb-sm-0 font-size-18" style="color: white !important">Settings</h4>
            {{-- {{ $errors }} --}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0 text-white">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" ript style="color: white !important">
                            DASHBOARD </a> / SETTINGS</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="w-100">


    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Basic Settings</button>
        </li>
       
        
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card p-4 rounded cShadow">

                <form action="{{ route('settings.edit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="row">
                        <h5 class="mb-2 mt-2 text-center bg-secondary p-3 text-white">:: BASIC ADMIN PANEL SETTINGS ::
                        </h5>
                        <div class="form-group col-sm-6 mb-2">
                            <label for=""> Admin Name:</label>
                            <input required type="text" name="name"
                                value="{{ !is_null($user->name) ? $user->name : '' }}" class="form-control">
                            @if ($errors->has('name'))
                                <span class="text-danger ml-2">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6 mb-2">

                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-3 col-xl-3 col-lg-3 mb-2">
                                <label for="">New Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="new_password" name="password" autocomplete="current-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            onclick="togglePasswordVisibility('new_password', 'new_password_icon')">
                                            <i id="new_password_icon" class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-sm-6 col-md-3 col-xl-3 col-lg-3 mb-2">
                                <label for="">Confirm Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="confirm_password" name="password_confirmation"
                                        autocomplete="current-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            onclick="togglePasswordVisibility('confirm_password', 'confirm_password_icon')">
                                            <i id="confirm_password_icon" class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger ml-2">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 col-md-3 col-xl-3 col-lg-3 mb-2">
                                <label for=""> Profile Image:</label>
                                <input type="file" name="profile_image"
                                    value="{{ !is_null($user->profile_image) ? $user->profile_image : '' }}" class="form-control"
                                    accept="image/*">
                                @if ($errors->has('profile_image'))
                                    <span class="text-danger ml-2">{{ $errors->first('profile_image') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <img class="rounded-circle header-profile-user"
                                    src="{{ isset(Auth::user()->profile_image) ? asset(Auth::user()->profile_image) : asset('/assets/admin/images/default_thumbnail.png') }}"
                                    style="width:100px;height:100px;" alt="Header Avatar">
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-sm-12 mb-2">
                        <input id="saveButton" type="submit" value="Save Settings" class="btn btn-primary btn-md">
                    </div>
                </form>
            </div>
        </div>

        
        
    </div>


</div>
</div>
<script>
    function togglePasswordVisibility(inputId, iconId) {
        var passwordInput = document.getElementById(inputId);
        var passwordIcon = document.getElementById(iconId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = "password";
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }

</script>
@endsection