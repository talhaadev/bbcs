@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-4">
        <h4>Reset Password via Phone</h4>

        <form id="otp-form">
            <div class="form-group">
                <label for="phone">Phone Number (e.g., +923001234567)</label>
                <input id="phone" type="text" class="form-control" required>
            </div>

            <div id="recaptcha-container" class="my-3"></div>

            <button type="button" class="btn btn-primary" id="send-otp-btn">Send OTP</button>

            <div class="form-group mt-3">
                <label for="otp">Enter OTP</label>
                <input type="text" id="otp" class="form-control" placeholder="Enter OTP">
            </div>

            <button type="button" class="btn btn-success mt-2" id="verify-otp-btn">Verify OTP</button>

            <div id="otp-status" class="mt-3 text-info"></div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- ✅ Firebase v8 SDK (non-modular) -->
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const firebaseConfig = {
            apiKey: "AIzaSyCOuLj-TkX4oownufWUmD0pRPrd5QZIkoc",
            authDomain: "bbcs-616f4.firebaseapp.com",
            projectId: "bbcs-616f4",
            storageBucket: "bbcs-616f4.appspot.com",
            messagingSenderId: "243392682929",
            appId: "1:243392682929:web:7309d9a9ee5cb4b6d73b90"
        };

        firebase.initializeApp(firebaseConfig);

        let confirmationResult = null;
        const phoneInput = document.getElementById("phone");
        const otpInput = document.getElementById("otp");
        const statusBox = document.getElementById("otp-status");

        // Setup reCAPTCHA
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            size: 'normal',
            callback: function () {
                console.log("reCAPTCHA verified");
            }
        });

        recaptchaVerifier.render();

        // Send OTP
        document.getElementById("send-otp-btn").addEventListener("click", function () {
            const phone = phoneInput.value.trim();
            if (!phone.startsWith('+')) {
                alert("Phone number must be in international format, e.g., +923001234567");
                return;
            }

            firebase.auth().signInWithPhoneNumber(phone, window.recaptchaVerifier)
                .then(result => {
                    confirmationResult = result;
                    statusBox.innerText = "✅ OTP sent to " + phone;
                })
                .catch(error => {
                    console.error(error);
                    statusBox.innerText = "❌ Error: " + error.message;
                });
        });

        // Verify OTP
        document.getElementById("verify-otp-btn").addEventListener("click", function () {
            const code = otpInput.value.trim();
            if (!confirmationResult) {
                statusBox.innerText = "❌ Send OTP first.";
                return;
            }

            confirmationResult.confirm(code)
                .then(result => {
                    statusBox.innerText = "✅ OTP verified successfully. Redirecting...";
                    setTimeout(() => {
                        window.location.href = "/password/reset-phone"; // adjust this
                    }, 1500);
                })
                .catch(error => {
                    console.error(error);
                    statusBox.innerText = "❌ Invalid OTP: " + error.message;
                });
        });
    });
</script>
@endpush
