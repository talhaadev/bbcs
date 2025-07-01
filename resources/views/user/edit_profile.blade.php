@extends('user.layouts.app')
@section('content')
    <style>
        .image-listview>li a.item:after {
            display: none;
        }
    </style>

    <div class="col-lg-12 container" style="margin-left: 100px; margin-top: 150px; background-color: white">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="color: white"><strong>Update</strong></h4>
                <div class="basic-form">
                    <form action="{{ url('user/profile/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="Name" class="label-control">Name</label>
                            <input type="text" name="name" class="form-control input-default"
                                value="{{ $user->name }}">
                        </div>

                        <div class="col-md-6">
                            <label for="Phone" class="label-control">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control input-default"
                                value="{{ $user->phone_number }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="image" class="label-control">Image</label>
                            <input type="file" name="image" class="form-control input-default"
                                value="{{ $user->image }}">
                        </div>
                </div>
            </div>
            <button type="submit" class="btn btn-dark mt-3" style="margin-top: 10px">Save</button>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
