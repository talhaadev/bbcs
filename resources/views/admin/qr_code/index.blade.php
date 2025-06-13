@extends('layouts.admin')
@section('title', 'QR Codes')
@section('css')

<style>

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
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">QR Codes</h4>
            {{-- {{ $errors }}--}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">QR Codes</li>
                </ol>

                <button type="button" class="btn btn-primary mt-2" href="javascript:void(0)" id="createNewCouponCode">
                    <i class="fa fa-plus"></i> Generate New QR Code
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
                            <th>QR Code</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Total Videos</th>
                            <th>Generated AT</th>
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
                    <input type="hidden" name="qr_code_id" id="videoQrCodeId">
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


<!-- QR Code Modal -->
<div class="modal fade" id="qrImageModal" tabindex="-1" role="dialog" aria-labelledby="qrImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg rounded-4">
            <div class="modal-header border-0">
                <h4 class="modal-title fw-bold" id="modelHeading">QR Code</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-4">
                <img src="" id="qrModalImage" class="img-fluid mb-4 border rounded" style="max-height: 400px;">
                <!-- Social Share Icons -->
                <div class="social-share-icons d-flex justify-content-center gap-3">
                    <a href="#" data-bs-toggle="tooltip" target="_blank" class="social-icon facebook" title="Share on Facebook" id="facebookShare"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" data-bs-toggle="tooltip" target="_blank" class="social-icon twitter" title="Share on Twitter" id="twitterShare"><i class="fab fa-twitter"></i></a>
                    <a href="#" data-bs-toggle="tooltip" target="_blank" class="social-icon whatsapp" title="Share on WhatsApp" id="whatsappShare"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" data-bs-toggle="tooltip" target="_blank" class="social-icon telegram" title="Share on Telegram" id="telegramShare"><i class="fab fa-telegram-plane"></i></a>
                    <a href="#" data-bs-toggle="tooltip" class="social-icon link" id="copyQrLinkBtn" title="Copy Link"><i class="fas fa-link"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="qrModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Generate QR Code</h4>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <label>Select QR Type</label>
                <select id="qrType" style="width:100%; margin-bottom:10px;" class="form-select">
                    <option value="">-- Select Type --</option>
                    <option value="welcome">Welcome</option>
                    <option value="video">Video</option>
                </select>
                <div id="qrTypeError" style="color:red; display:none; margin-top:5px;"></div>
                
                <div id="categoryWrapper" style="display:none;">
                    <label>Category</label>
                    <select id="category" style="width:100%; margin-bottom:10px;" class="form-select">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div id="categoryError" style="color:red; display:none; margin-top:5px;"></div>
                </div>

                <div id="subcategoryWrapper" style="display:none;">
                    <label>Subcategory</label>
                    <select id="subcategory" style="width:100%; margin-bottom:10px;" class="form-select">
                        <option value="">-- Select Subcategory --</option>
                    </select>
                </div>
                <div class="modal-footer py-1">
                    <button id="closeModalBtn" type="button" class="btn btn-outline-primary">Close</button>
                    <button type="submit" class="btn btn-primary button-spinner" id="generateQRCode"
                        value="create">Generate QR Code</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QR code will be rendered here but hidden -->
<div id="qrcode" style="display:none;"></div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    $(document).on('click', '.qr-modal-img', function () {
        const imgSrc = $(this).attr('src');
        $('#qrModalImage').attr('src', imgSrc);

        const appUrl = "{{ env('APP_URL') }}";
        const imageUrl = appUrl + imgSrc;

        $('#facebookShare').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(imageUrl)}`);
        $('#twitterShare').attr('href', `https://twitter.com/intent/tweet?url=${encodeURIComponent(imageUrl)}&text=Check%20out%20this%20QR%20code`);
        $('#whatsappShare').attr('href', `https://wa.me/?text=${encodeURIComponent(imageUrl)}`);
        $('#telegramShare').attr('href', `https://t.me/share/url?url=${encodeURIComponent(imageUrl)}&text=QR%20code%20image`);

        $('#qrImageModal').modal({
            backdrop: 'static',
            keyboard: false
        }).modal('show');
    });



    $('#copyQrLinkBtn').on('click', function () {
        const qrImageUrl = $('#qrModalImage').attr('src');
        const appUrl = "{{ env('APP_URL') }}";
        const imageUrl = appUrl + qrImageUrl;
        navigator.clipboard.writeText(imageUrl).then(() => {
        });
    });
</script>


<script>
    $('body').on('click', '#closeModalBtn', function () {
        $('#qrModal').modal('hide');
    });
    document.getElementById('createNewCouponCode').addEventListener('click', function () {
        // Clear error messages
        const typeError = document.getElementById('qrTypeError');
        const categoryError = document.getElementById('categoryError');
        typeError.innerText = '';
        typeError.style.display = 'none';
        categoryError.innerText = '';
        categoryError.style.display = 'none';

        // Reset all form fields
        document.getElementById('qrType').value = '';
        document.getElementById('category').value = '';
        document.getElementById('subcategory').value = '';

        // Hide category and subcategory wrappers
        document.getElementById('categoryWrapper').style.display = 'none';
        document.getElementById('subcategoryWrapper').style.display = 'none';

        // Clear subcategory options
        document.getElementById('subcategory').innerHTML = '<option value="">-- Select Subcategory --</option>';

        // Show the modal
        $('#qrModal').modal({
            backdrop: 'static',
            keyboard: false
        }).modal('show');
    });

    document.getElementById('qrType').addEventListener('change', function () {
        const selectedType = this.value;
        document.getElementById('categoryWrapper').style.display = (selectedType === 'video') ? 'block' : 'none';
        document.getElementById('subcategoryWrapper').style.display = 'none';
    });

    document.getElementById('category').addEventListener('change', function () {
        const categoryId = this.value;
        if (!categoryId) return;

        fetch(`/subcategories/by-category/${categoryId}`) // Your route here
            .then(res => res.json())
            .then(data => {
                const subcategorySelect = document.getElementById('subcategory');
                subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';

                data.forEach(sub => {
                    subcategorySelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                });

                document.getElementById('subcategoryWrapper').style.display = 'block';
            });
    });


    document.getElementById('generateQRCode').addEventListener('click', function () {
        const type = document.getElementById('qrType').value;
        const typeError = document.getElementById('qrTypeError');
        const categoryId = document.getElementById('category').value;
        const subcategoryId = document.getElementById('subcategory').value;
        const categoryError = document.getElementById('categoryError');

        if (!type) {
            typeError.innerText = 'Please select type.';
            typeError.style.display = 'block';
            return;
        } else {
            typeError.innerText = '';
            typeError.style.display = 'none';
        }

        if (!categoryId) {
            categoryError.innerText = 'Please select a category.';
            categoryError.style.display = 'block';
            return;
        } else {
            categoryError.innerText = '';
            categoryError.style.display = 'none';
        }
        const loader = document.createElement('div');
        loader.style.position = 'fixed';
        loader.style.top = '0';
        loader.style.left = '0';
        loader.style.width = '100%';
        loader.style.height = '100%';
        loader.style.background = 'rgba(0,0,0,0.5)';
        loader.style.zIndex = '9999';
        loader.style.display = 'flex';
        loader.style.alignItems = 'center';
        loader.style.justifyContent = 'center';
        loader.innerHTML = `<div style="border: 5px solid #f3f3f3; border-top: 5px solid #3498db; border-radius: 50%; width: 60px; height: 60px; animation: spin 1s linear infinite;"></div>
            <style>@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }</style>`;
        document.body.appendChild(loader);

        const formData = new FormData();
        formData.append('type', type);
        formData.append('category_id', categoryId);
        formData.append('sub_category_id', subcategoryId);

        fetch("{{ route('qr_codes.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => res.json())
        .then(response => {
            if (response.success && response.qr_code_id) {
                const qrData = response.view_url;
                document.getElementById('qrcode').innerHTML = '';

                const qr = new QRCode(document.getElementById("qrcode"), {
                    text: qrData,
                    width: 200,
                    height: 200,
                });

                setTimeout(function () {
                    const qrCanvas = document.querySelector("#qrcode canvas");
                    if (qrCanvas) {
                        const base64Image = qrCanvas.toDataURL("image/png");

                        fetch(base64Image)
                            .then(res => res.blob())
                            .then(blob => {
                                const uploadImageForm = new FormData();
                                uploadImageForm.append('qr_code_id', response.qr_code_id);
                                uploadImageForm.append('qr_code', blob, 'qrcode.png');

                                fetch("{{ route('qr_codes.store') }}", {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: uploadImageForm
                                })
                                .then(res => res.json())
                                .then(uploadResponse => {
                                    document.body.removeChild(loader);
                                    $('#qrModal').modal('hide');

                                    if (uploadResponse.success) {
                                        Toast.fire({
                                            icon: 'success',
                                            title: uploadResponse.success
                                        });
                                        table.draw();
                                    } else {
                                        alert(uploadResponse.error || 'Image upload failed');
                                    }
                                });
                            });
                    }
                }, 500);
            } else {
                document.body.removeChild(loader);
                alert(response.error || 'QR Code creation failed');
            }
        })
        .catch(err => {
            document.body.removeChild(loader);
            console.error(err);
        });
    });



</script>

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
            url: '{{ route('qr_codes.index') }}',
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
                data: 'qr_code',
                name: 'qr_code'
            },
            {
                data: 'category_name',
                name: 'category_name'
            },
            {
                data: 'sub_category_name',
                name: 'sub_category_name'
            },
            {
                data: 'video_count',
                name: 'video_count'
            },
            
            {
                data: 'creation_time',
                name: 'creation_time',
            },
           
            {
                data: 'actions',
                name: 'actions'
            },
        ]
    });

    
    $('body').on('click', '#closeModalBtn', function () {
        $('#ajaxModel').modal('hide');
    });

    
</script>

<script>
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
                table.draw();
                Toast.fire({
                    icon: 'success',
                    title: response.success
                });
            },
            error: function (xhr) {
                $('#uploadProgressContainer').hide();
                $('#uploadVideosForm').show();
                alert('Video upload failed');
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
</script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.deleteCouponCode', function () {

            var qr_code_id = $(this).data("id");
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
                        url: "{{ route('qr_codes.store') }}" + '/' + qr_code_id,
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
</script>
@endsection