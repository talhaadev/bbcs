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
            <h4 class="mb-sm-0 font-size-18" style="color: white !important">Deposits</h4>
            {{-- {{ $errors }} --}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0 text-white">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" ript style="color: white !important">
                            DASHBOARD </a> / Deposits</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="w-100">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="depositsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deposits as $ind => $deposit)
                        <tr>
                            <td>{{ $ind + 1 }}</td>
                            <td>{{ $deposit->user->name }}</td>
                            <td>${{ number_format($deposit->amount, 2) }}</td>
                            <td>
                                @if($deposit->status == 'pending')
                                <span class="badge bg-warning">{{ $deposit->status }}</span>
                                @elseif($deposit->status == 'accepted')
                                <span class="badge bg-success">{{ $deposit->status }}</span>
                                @elseif($deposit->status == 'rejected')
                                <span class="badge bg-danger">{{ $deposit->status }}</span>
                                @endif
                            </td>
                            <td>{{ $deposit->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                @if($deposit->status == 'pending')
                                <a href="{{url('/admin/deposit/status/'.$deposit->id.'?status=accepted')}}" class="btn btn-success">Accept Now</a>
                                <a href="{{url('/admin/deposit/status/'.$deposit->id.'?status=rejected')}}" class="btn btn-danger">Reject Now</a>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>





</div>
</div>

@endsection
