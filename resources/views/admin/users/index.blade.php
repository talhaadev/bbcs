@extends('layouts.admin')
@section('title', 'Scaned Users')
@section('css')


@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Scaned Users</h4>
            {{-- {{ $errors }}--}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Scaned Users</li>
                </ol>

            </div>
        </div>
    </div>
</div>

<div class="w-100">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card p-4 rounded cShadow table-responsive">
                <table id="datatable" class="table table-bordered  table-hover dt-responsive display nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            {{-- <th>Email</th>
                            <th>Phone</th> --}}
                            <th>IP Address</th>
                            <th>Scan Count</th>
                            <th>Registered AT</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


<script>

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on('mouseover', '[data-toggle="tooltip"]', function () {
        $(this).tooltip();
    });

    $('.search_btn').on('click', function () {
        table.draw();
    });

    var table = $('#datatable').DataTable({
        responsive: true,
        serverSide: true,
        searching: false,
        processing: true,
        ordering: false,

        ajax: {
            url: '{{ route('users.index') }}',
            type: 'GET',
            dataType: 'JSON',
            accepts: 'JSON',
            dom: 'frtip',
            data: function (d) {
                d.page = (d.start / d.length) + 1;
            },
            beforeSend: function () { },
            dataSrc: function (response) {
                return response.data;
            }
        },
        columns: [

            {
                data: 'name',
                name: 'name'
            },
            // {
            //     data: 'email',
            //     name: 'email'
            // },
            // {
            //     data: 'phone_number',
            //     name: 'phone_number'
            // },
            {
                data: 'ip',
                name: 'ip'
            },
            {
                data: 'scan_count',
                name: 'scan_count'
            },
            
            {
                data: 'creation_time',
                name: 'creation_time',
            },
           
        ]
    });

    
    $('body').on('click', '#closeModalBtn', function () {
        $('#ajaxModel').modal('hide');
    });

    
</script>


@endsection