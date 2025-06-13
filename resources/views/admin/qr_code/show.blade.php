@extends('layouts.admin')
@section('title', 'QR Code Videos')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
<style>
.video-container {
    position: relative;
    width: 100%;
    padding-top: 56.25%; /* 16:9 Aspect Ratio */
    border-radius: 12px;
    overflow: hidden;
}
.video-container video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.delete-video
 {
    position: absolute;
    top: -20px;
    right: -12px;
    background: rgba(255, 0, 0, 0.8);
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 25px;
    line-height: 1;
}
</style>


<style>
    .upload-box {
        border: 2px dashed #141414;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        background-color: #f8f9fa;
        transition: background-color 0.3s;
        position: relative;
    }
    .upload-box:hover {
        background-color: #e9ecef;
    }
    .upload-box input[type="file"] {
        display: none;
    }
    .upload-preview {
        margin-top: 15px;
    }
    .upload-preview img {
        max-width: 100px;
        max-height: 100px;
        border-radius: 8px;
        object-fit: cover;
    }
    .application-input{
        width: 100%;
        padding: 12px 50px 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }


    .progress-bar-container {
        width: 100%;
        height: 25px;
        background-color: #f0f0f0;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
        animation: fadeIn 0.5s ease-in-out;
    }

    .progress-bar-fill {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        text-align: center;
        line-height: 25px;
        font-weight: bold;
        border-radius: 30px;
        transition: width 0.4s ease;
    }

    .progress-text {
        font-size: 14px;
        color: #555;
        text-align: center;
        margin-top: -10px;
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }


.social-share-icons .social-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background-color: #f1f1f1;
    color: #555;
    font-size: 16px;
    transition: all 0.3s ease-in-out;
    text-decoration: none;
}

.social-icon.facebook:hover { background-color: #3b5998; color: white; }
.social-icon.twitter:hover { background-color: #1da1f2; color: white; }
.social-icon.whatsapp:hover { background-color: #25d366; color: white; }
.social-icon.telegram:hover { background-color: #0088cc; color: white; }
.social-icon.link:hover { background-color: #333; color: white; }

.modal-content {
    border: none;
    border-radius: 1rem;
}


#videosTable tbody tr {
    cursor: move;
    transition: background-color 0.2s ease;
}

#videosTable tbody tr:hover {
    background-color: #f5f5f5;
}

#videosTable tbody tr::before {
    font-size: 18px;
    color: #888;
    margin-right: 10px;
    display: inline-block;
    vertical-align: middle;
    opacity: 0;
    transition: opacity 0.2s ease;
}

#videosTable tbody tr:hover::before {
    opacity: 1;
}

</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">QR Code Videos</h4>
            {{-- {{ $errors }}--}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">QR Code Videos</li>
                </ol>
                <a type="button" class="btn btn-primary mt-2" href="{{ route('qr_codes.index') }}" id="">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <a data-toggle="tooltip" title="Upload Videos" href="javascript:void(0)" data-toggle="tooltip"  data-id="{{$qrCode->id}}" data-original-title="Edit" class="mr-3 mt-2  btn btn-outline-success uploadVideos"><i class="fa fa-upload"></i> Upload Video </a> 
                
            </div>
        </div>
    </div>
</div>
<div class="w-100">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card p-4 rounded cShadow">
            <table id="videosTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="cursor: move;">#</th> <!-- draggable handle -->
                        <th>Video</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($videos as $index => $video)
                        <tr data-id="{{ $video->id }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div>
                                    <video width="250" height="200" controls>
                                        <source src="{{ asset($video->video) }}" type="video/mp4">
                                        Your browser does not support HTML5 video.
                                    </video>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger delete-video-btn" data-id="{{ $video->id }}" title="Delete Video">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No videos found for this QR code.</td>
                        </tr>
                    @endforelse
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
                <h4 class="modal-title" id="modelHeading">Upload Videos</h4>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="uploadProgressContainer" style="display: none;">
                    <div class="progress-bar-container">
                        <div id="uploadProgressBar" class="progress-bar-fill">0%</div>
                    </div>
                    <p class="progress-text">Uploading videos, please wait...</p>
                </div>

                <form id="uploadVideosForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="qr_code_id" id="videoQrCodeId" value="{{ $qrCode->id }}">
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Select Videos</label>
                        <div class="upload-box"
                            onclick="triggerInput('videoInput')"
                            ondragover="handleDrag(event)"
                            ondragleave="handleLeave(event)"
                            ondrop="handleDrop(event, 'videoInput')">
                            <p class="mb-0 text-muted">Drag & drop videos here or click to select</p>
                            <input type="file" name="videos[]" id="videoInput" multiple accept="video/*" onchange="previewVideoNames(event)" >
                        </div>
                        <div class="text-danger" id="videoInput_error"></div>
                        <div class="upload-preview" id="videoInput_preview"></div>
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

<script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });


    $(document).on("click", ".delete-video-btn", function () {
        var videoId = $(this).data("id");
        var $button = $(this);

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success m-2",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "This action will permanently delete the video.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!",
            cancelButtonText: "No, Cancel it",
            reverseButtons: true,
            allowOutsideClick: false,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: `/delete-video/${videoId}`,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            resolve(response);
                        },
                        error: function(xhr) {
                            reject(`Request failed: ${xhr.responseText}`);
                        }
                    });
                }).catch(errorMsg => {
                    Swal.showValidationMessage(errorMsg);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $button.closest('.col-md-6').remove();
                Toast.fire({
                    icon: 'success',
                    title: 'Video deleted successfully!'
                });
                window.location.reload();
            }
        });
    });
</script>
<script>
    function previewVideoNames(event) {
        const input = event.target;
        const previewBox = document.getElementById(input.id + '_preview');
        previewBox.innerHTML = '';

        if (input.files) {
            Array.from(input.files).forEach(file => {
                const div = document.createElement('div');
                div.classList.add('text-muted');
                div.style.fontSize = '14px';
                div.innerText = '🎬 ' + file.name;
                previewBox.appendChild(div);
            });
        }
    }

    function triggerInput(id) {
        document.getElementById(id).click();
    }

    function handleDrag(e) {
        e.preventDefault();
        e.currentTarget.classList.add('dragover');
    }

    function handleLeave(e) {
        e.preventDefault();
        e.currentTarget.classList.remove('dragover');
    }

    function handleDrop(e, fieldId) {
        e.preventDefault();
        e.currentTarget.classList.remove('dragover');

        const input = document.getElementById(fieldId);
        input.files = e.dataTransfer.files;

        previewVideoNames({ target: input });
    }
    $('body').on('click', '#closeModalBtn', function () {
        $('#ajaxModel').modal('hide');
    });
    $(document).on('click', '.uploadVideos', function () {
        $('#uploadVideosForm').trigger("reset");
        const qrCodeId = $(this).data('id');
        $('#videoQrCodeId').val(qrCodeId);
        $('#videoInput_preview').empty();
        $('#videoInput_error').empty();
        $('#ajaxModel').modal({
            backdrop: 'static',
            keyboard: false
        }).modal('show');
    });


    $('#uploadVideosForm').on('submit', function (e) {
        e.preventDefault();

        const input = document.getElementById('videoInput');
        const files = input.files;
        const errorDiv = $('#videoInput_error');
        errorDiv.text(''); // Clear previous errors

        // Validate: Check if files selected
        if (files.length === 0) {
            errorDiv.text('Please select at least one video.');
            input.focus();
            return;
        }

        // Validate: Check if all files are videos
        for (let i = 0; i < files.length; i++) {
            if (!files[i].type.startsWith('video/')) {
                errorDiv.text('Only video files are allowed.');
                input.focus();
                return;
            }
        }

        // Proceed with upload if valid
        let formData = new FormData(this);
        $('#uploadVideosForm').hide();
        $('#uploadProgressContainer').show();

        $.ajax({
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $('#uploadProgressBar').css('width', percentComplete + '%');
                        $('#uploadProgressBar').text(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: '{{ route('qr_codes.upload') }}',
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#uploadProgressContainer').hide();
                $('#uploadVideosForm').show();
                $('#ajaxModel').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: response.success
                });
                window.location.reload();
            },
            error: function (xhr) {
                $('#uploadProgressContainer').hide();
                $('#uploadVideosForm').show();
                alert('Video upload failed');
            }
        });
    });
</script>
@if (count($videos) > 0)
<script>
    const table = $('#videosTable').DataTable({
        searching: false,
        rowReorder: {
            selector: 'td' // enables drag on all <td> cells
        },

        columnDefs: [
            { orderable: false, targets: [1, 2] }
        ]
    });

    // Handle reordering
    table.on('row-reorder', function (e, diff, edit) {
        let reorderedData = [];

        for (let i = 0; i < diff.length; i++) {
            let videoId = $(diff[i].node).data('id');
            reorderedData.push({
                id: videoId,
                new_position: diff[i].newData
            });
        }

        if (reorderedData.length > 0) {
            $.ajax({
                url: '{{ route("videos.reorder") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order: reorderedData
                },
                success: function (response) {
                    console.log("Order updated:", response);
                },
                error: function (xhr) {
                    alert("Reordering failed.");
                }
            });
        }
    });
</script>
@endif



@endsection