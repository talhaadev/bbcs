@extends('layouts.admin')
@section('title', 'Category')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@20.1.0/build/css/intlTelInput.css">

<style>
    .intl-tel-input,
    .iti {
        width: 100%;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
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
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Categories</h4>
            {{-- {{ $errors }}--}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>

                <button type="button" class="btn btn-primary mt-2" href="javascript:void(0)" id="createNewCouponCode">
                    <i class="fa fa-plus"></i> Add New Category
                </button>
            </div>
        </div>
    </div>
</div>
<div class="card">

    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" name="filter_name" class="form-control" id="filter_name"
                        placeholder="🔍 Search by category name" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select name="filter_status" class="filter_status form-control" id="exampleFormControlSelect1">
                        <option value="">--- Select Category Status ---</option>
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-md btn-primary float-right button-spinner search_btn">
                    <i class="fa fa-filter"></i> Filter
                </button>
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
                            <th>Icon</th>
                            <th>Name</th>
                            <th> Date & Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Model -->
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="SellerForm" name="SellerForm" class="form-horizontal">
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Category Name</label>
                        <div class="col-sm-12">
                            <input required type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Category Name" value="" maxlength="50">
                            <span id="nameError" class="error"></span>
                        </div>
                    </div>
                    <div class="form-group pt-2">
                        <label for="name" class="col-sm-12 control-label">Category Icon</label>
                        <div class="col-sm-12">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <img src="" id="image_preview" alt="" class="pt-4" height="100px;">
                    </div>
                    
                    <div class="form-group pt-2">
                        <label class="col-12 control-label">Status</label>
                        <div class="custom-control custom-switch" bis_skin_checked="1">
                            <label class="switch">
                                <input id="status" name="status" class="time_toggle" value="1" type="checkbox"><span
                                    class="slider round"></span>
                                <label class="custom-control-label" style="padding-left: 50px;"
                                    for="group_status">Active</label>
                            </label>

                        </div>
                    </div>

                    <div class="modal-footer py-1">
                        <button id="closeModalBtn" type="button" class="btn btn-outline-primary">Close</button>
                        <button type="submit" class="btn btn-primary button-spinner" id="saveBtn"
                            value="create">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@20.1.0/build/js/intlTelInput.min.js"></script>


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
            url: '{{ route('category.index') }}',
            type: 'GET',
            dataType: 'JSON',
            accepts: 'JSON',
            dom: 'frtip',
            data: function (d) {
                d.filter_name = $('input[name=filter_name]').val();
                d.filter_status = $('select[name=filter_status]').val();
                d.page = (d.start / d.length) + 1;
            },
            beforeSend: function () { },
            dataSrc: function (response) {
                return response.data;
            }
        },
        columns: [
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'name',
                name: 'name'
            },
            
            {
                data: 'creation_time',
                name: 'creation_time',
            },
            {
                data: 'active_status',
                name: 'active_status',
            },
            {
                data: 'actions',
                name: 'actions'
            },
        ]
    });

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#createNewCouponCode').click(function () {
            $('#nameError').html('');
            $('#SellerForm').trigger("reset");
            $('#category_id').val('');
            $('#image_preview').attr("src", "{{ asset('/assets/images/default_thumbnail.png') }}");
            $('#modelHeading').html("Create New Category");
            $('#ajaxModel').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show');

        });


        $('body').on('click', '.editCouponCode', function () {

            var category_id = $(this).data('id');
            $.get("{{ route('category.index') }}" + '/' + category_id + '/edit', function (data) {
                $('#modelHeading').html("Edit Category");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal({
                    backdrop: 'static',
                    keyboard: false
                }).modal('show');
                $('#nameError').html('');
                $('#category_id').val(data.id);                
                $('#name').val(data.name);
                if (data.image) {
                    $('#image_preview').attr("src", data.image);
                } else {
                    $('#image_preview').attr("src", "{{ asset('/assets/images/default_thumbnail.png') }}");
                }
                
                $('#status').prop('checked', data.status == 1);
            })

        });

        $('body').on('click', '.deleteCouponCode', function () {

            var category_id = $(this).data("id");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success m-2",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete it!",
                cancelButtonText: "No , Cancel it",
                reverseButtons: true,
                allowOutsideClick: false,
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('category.store') }}" + '/' + category_id,
                        success: function (data) {
                            table.draw();
                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            });
                        },
                        error: function (data) {
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Handle cancellation if needed
                }
            });
        });




    });

    $('body').on('click', '#closeModalBtn', function () {
        $('#ajaxModel').modal('hide');
    });

    document.addEventListener('DOMContentLoaded', function () {


        var form = document.getElementById('SellerForm');
        var saveBtn = document.getElementById('saveBtn');

        saveBtn.addEventListener('click', function (e) {
            e.preventDefault();
            var formData = new FormData($('#SellerForm')[0]);
            // Check if the form is valid
            if (validateForm()) {

                $.ajax({
                    data: formData,
                    url: "{{ route('category.store') }}",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#SellerForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                        table.draw();
                    },
                    error: function (xhr, status, error) {
                        if (xhr.status === 422) {
                            var errorMessages = xhr.responseJSON.errors;

                            // Collect all error messages into a single string
                            var message = '';
                            for (var key in errorMessages) {
                                if (errorMessages.hasOwnProperty(key)) {
                                    message += errorMessages[key].join(' ') + '<br>';
                                }
                            }
                            Toast.fire({
                                icon: 'error',
                                title: message
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Something went wrong, please try again.'
                            });
                        }
                    }
                });
            }
        });



        function validateForm() {
            var nameInput = document.getElementById('name');
            var nameError = document.getElementById('nameError');

           
           
            // Reset error messages
            nameError.textContent = '';

            // Validate name
            if (nameInput.value.trim() === '') {
                nameError.textContent = 'Name is required.';
                return false;
            } else if (nameInput.value.length < 3) {
                nameError.textContent = 'Name must be at least 3 characters.';
                return false;
            }



            return true;
        }
    });
</script>
<script>
    document.getElementById('image').onchange = function (event) {
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    };
</script>
@endsection