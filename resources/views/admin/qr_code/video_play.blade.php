<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code Video</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap (optional, for layout and alerts) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Plyr CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
   
    <style>
        .intl-tel-input,
            .iti{
                width: 100%;
            }
        body {
            background: #f9f9f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 60px;
            margin-bottom: 60px;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .plyr__video-wrapper {
            border-radius: 12px;
            overflow: hidden;
        }
        h3 {
            font-weight: 600;
            color: #333;
        }
    </style>
</head>
<body style="background: #D3D3FF;">

<div class="w-100 p-4">
    <div class="">
        @if ($video)
            <video id="player" playsinline controls muted autoplay>
                <source src="{{ asset($video->video) }}" type="video/mp4" />
                Your browser does not support HTML5 video.
            </video>
        @else
            <div class="alert alert-warning text-center mt-4">
                No video found for this QR code.
            </div>
        @endif
    </div>
</div>

<!-- Plyr JS -->
<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

<script>
    // Initialize Plyr
    const player = new Plyr('#player');
</script>

</body>
</html>
