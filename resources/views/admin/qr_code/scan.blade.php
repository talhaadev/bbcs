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
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            background-image: url('');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Quicksand', sans-serif;
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
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            color: #5A4FCF;
        }


        .form-wrapper {
            background-color: rgba(255, 255, 255, 0.95); /* Semi-transparent */
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .form-wrapper::before {
            background-image: url('{{ asset('assets/images/girls_group.png') }}');
            content: "";
            background-size: contain; /* or cover depending on your goal */
            background-repeat: no-repeat;
            background-position: center;
            position: absolute;
            top: 0; /* make sure it's positioned */
            left: 0;
            width: 100%; /* take full width of container or custom width */
            height: 100%; /* full height */
            opacity: 0.2; /* adjust as needed */
            z-index: 0; /* stay behind form content */
        }

        @media (max-width: 767.98px) {
            .form-wrapper::before {
                background-size: cover; /* Stretch to fill */
                background-position: top center; /* Align better for tall image */
                opacity: 0.2; /* Slightly more visible if needed */
            }
        }

        .form-wrapper:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 0.75rem;
            font-size: 1rem;
            padding: 0.75rem 1rem;
            background-color: #fdfdfd;
            transition: all 0.3s ease;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: #D3D3FF; /* Your custom soft teal */
            background-color: #ffffff;
            box-shadow: none; /* Remove Bootstrap blue glow */
            outline: none; /* Remove browser default outline */
        }


        label {
            font-weight: 600;
            color: #666;
        }


        @media (max-width: 576px) {
            .form-wrapper {
                padding: 2rem 1.5rem;
            }

            .form-control-lg {
                font-size: 0.95rem;
                padding: 0.75rem 1rem;
            }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }


        

       .next-teal-btn {
            all: unset;
            display: inline-block;
            width: 100%;
            padding: 0.85rem 1.75rem;
            background: linear-gradient(135deg, #7f75ff, #5a4fcf); /* gradient purple-blue */
            color: #fff;
            text-align: center;
            font-size: 1.05rem;
            font-weight: 700;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 6px 16px rgba(90, 79, 207, 0.4);
            transition: background 0.4s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        .next-teal-btn:hover {
            background: linear-gradient(135deg, #685eff, #4439c4);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(90, 79, 207, 0.5);
        }

        .next-teal-btn:active {
            transform: scale(0.97);
            background: linear-gradient(135deg, #5a4fcf, #3d32a9);
        }

        .next-teal-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(138, 130, 255, 0.6);
        }

        .next-teal-btn {
            font-family: 'Quicksand', sans-serif;
            letter-spacing: 0.5px;
        }

        @media (max-width: 991.98px) {
            h3 {
                font-size: 1.75rem;
            }
        }

        /* Mobile view (e.g., phones, below 768px) */
        @media (max-width: 767.98px) {
            h3 {
                font-size: 1.5rem;
                text-align: center;
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }


    </style>
</head>
<body style="background: #D3D3FF;">

<div class="p-4 w-100">
    <div class="container" id="welcome-form">
        <form id="welcomeForm" method="POST" action="">
            @csrf
            <div class="form-wrapper shadow p-4 p-md-5 rounded bg-white">
                <h3 class="text-center text-dark mb-4">Hey BEYOU GIRL. Enter your name below</h3>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name"
                            class="form-control form-control-lg" required>
                    </div>

                    <div class="col-md-12 d-flex align-items-end mb-4">
                        <button type="submit" class="next-teal-btn">
                            Proceed
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    
    <div class="" id="welcome-video" style="display: none;">

        @if ($welcome_video)
            <video id="player" playsinline controls>
                <source src="{{ asset($welcome_video->video) }}" type="video/mp4" />
                Your browser does not support HTML5 video.
            </video>
        @else
            <div class="alert alert-warning text-center mt-4">
                No video found for this QR code.
            </div>
        @endif
        <div class="d-flex justify-content-center mt-4">
            <button type="button" id="welcome-btn" class="next-teal-btn">
                Proceed
            </button>
        </div>
        
    </div>
    <div class="" id="random-video" style="display: none;">
        @if ($video)
            <video id="player-2" playsinline controls>
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

<!-- Loader -->
<div id="loader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background: rgba(0, 0, 0, 0.7); display: none; align-items: center; justify-content: center; z-index: 9999;">
    <div style="width: 80px; height: 80px; border: 6px solid #fff; border-top: 6px solid #D3D3FF; border-radius: 50%; animation: spin 1s linear infinite;"></div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    let Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        showCloseButton: true,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    @if(session()->has('success'))
    Toast.fire({
        icon: 'success',
        title: '{{ session()->get('success') }}'
    })
    @endif
    @if(session()->has('warning'))
    Toast.fire({
        icon: 'v',
        title: '{{ session()->get('warning') }}'
    })
    @endif
    @if(session()->has('error'))
    Toast.fire({
        icon: 'error',
        title: '{{ session()->get('error') }}'
    })
    @endif
</script>
<!-- Plyr JS -->
<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

<script>
    // Initialize Plyr
    const player = new Plyr('#player');
    const player2 = new Plyr('#player-2');
</script>

<script>
    document.getElementById('welcomeForm').addEventListener('submit', function(e) {
        e.preventDefault();

        document.getElementById("loader").style.display = "flex";
        document.body.style.pointerEvents = "none";

        const form = this;
        const formData = new FormData(form);

        fetch("{{ route('welcome.submit') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok.");
            return response.json();
        })
        .then(data => {
            if (data.success) {
                form.reset();
                document.getElementById("loader").style.display = "none";
                document.body.style.pointerEvents = "auto";
                // Toast.fire({
                //     icon: 'success',
                //     title: 'Form submitted successfully!'
                // });
                document.getElementById('welcome-form').style.display = "none";
                showElement('welcome-video', '');
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.message || "Something went wrong"
                });
            }
        })
        .catch(error => {
            Toast.fire({
                icon: 'error',
                title: "An error occurred. Please try again."
            });
        });
    });

    document.getElementById('welcome-btn').addEventListener('click', function() {
        document.getElementById('welcome-video').style.display = "none";
        showElement('random-video', 'welcome-video');
    });

    function showElement(idToShow, idToHide = '') {
        const hideEl = document.getElementById(idToHide);
        const showEl = document.getElementById(idToShow);

        if (hideEl) {
            hideEl.querySelectorAll('video').forEach(video => {
                video.pause();
                video.currentTime = 0;
            });
            hideEl.style.display = 'none';
        }

        if (showEl) {
            showEl.style.display = 'block';

            showEl.querySelectorAll('video').forEach(video => {
                video.muted = true;
                video.autoplay = true;
                video.play().catch(err => {
                    console.warn('Video play failed:', err);
                });
            });
        }
    }
</script>
</body>
</html>
