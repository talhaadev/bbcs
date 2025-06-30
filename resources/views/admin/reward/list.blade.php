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
            <h4 class="mb-sm-0 font-size-18" style="color: white !important">Reward List</h4>
            {{-- {{ $errors }} --}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0 text-white">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" ript style="color: white !important">
                            DASHBOARD </a> / Reward List</li>
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
                            <th>#SR</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rewards as $ind => $reward)
                        <tr>
                            <td>{{ $ind + 1 }}</td>
                            <td>{{ $reward->user->name }}</td>
                            <td> $ {{ $reward->amount }}</td>
                            <td>{{ $reward->created_at }}</td>
                            <td>
                            -
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form id="PercentageForm" action="" method="POST">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title" id="editUserLabel">Reward Percentage</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-2">
            <label>Reward Percentage</label>
            <input type="number" step="0.01" name="percentage" class="form-control RewardPercentage" value="">
          </div>

        </div>
        <div class="modal-footer py-1">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>



</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // When any .SetPercentageModel button is clicked
    $(document).on('click', '.SetPercentageModel', function () {
        let url = $(this).attr('url');
        let percentage = $(this).attr('percentage');

        // Update the modal form action and percentage input
        $('#PercentageForm').attr('action', url);
        $('.RewardPercentage').val(percentage);
    });
});
</script>


@endsection
