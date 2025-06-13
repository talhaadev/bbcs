@extends('layouts.admin')
@section('title', 'Welcome Video')
@section('css')
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
<style>



.btn-primary {
    font-weight: 600;
    border-radius: 10px;
    transition: background 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

</style>

@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Welcome Video</h4>
            {{-- {{ $errors }}--}}
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Welcome Video</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="w-100">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-4">
            <div class="card p-4 rounded shadow video-card">
                <h4 class="mb-4 text-center text-dark">Welcome Video</h4>

                @if(isset($video->video))
                    <div class="text-center mb-4">
                        <video id="player" playsinline controls>
                            <source src="{{ asset($video->video) }}" type="video/mp4" />
                            Your browser does not support HTML5 video.
                        </video>
                    </div>
                @endif

                <form action="{{ route('upload.welcomevideo') }}" method="POST" enctype="multipart/form-data" class="video-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($video->id) ? $video->id : '' }}">
                    <div class="form-group mb-3">
                        <label for="">Upload Welcome Video</label>
                        <input type="file" name="welcome_video" id="video" class="form-control" accept="video/*" required>
                        @error('video')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($video->id) ? 'Update Video' : 'Upload Video' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Plyr JS -->
<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

<script>
    // Initialize Plyr
    const player = new Plyr('#player');
</script>
@endsection