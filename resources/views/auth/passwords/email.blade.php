@extends('layouts.app')

@section('content')
<div class="register-card">
    <div class="register-header">{{ __('Reset Password via Phone') }}</div>

    <form id="otp-form">
        <div class="mb-3">
            <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
            <input id="phone" type="text"
                   class="form-control"
                   name="phone" placeholder="+923001234567"
                   required autofocus>
        </div>

        <div id="recaptcha-container" class="mb-3"></div>

        <button type="button" class="btn btn-secondary mb-3" id="send-otp-btn">
            {{ __('Send OTP') }}
        </button>

        <div class="mb-3">
            <label for="otp" class="form-label">{{ __('Enter OTP') }}</label>
            <input type="text" id="otp" class="form-control" placeholder="Enter OTP" />
        </div>

        <button type="button" class="btn btn-success" id="verify-otp-btn">
            {{ __('Verify OTP') }}
        </button>

        <div id="otp-status" class="mt-3 text-info"></div>
    </form>
</div>

<!-- Firebase SDKs -->
<script src="https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ✅ Firebase config
        const firebaseConfig = {
            apiKey: "AIzaSyCOuLj-TkX4oownufWUmD0pRPrd5QZIkoc",
            authDomain: "bbcs-616f4.firebaseapp.com",
            projectId: "bbcs-616f4",
            storageBucket: "bbcs-616f4.firebasestorage.app",
            messagingSenderId: "243392682929",
            appId: "1:243392682929:web:7309d9a9ee5cb4b6d73b90",
            measurementId: "G-FEVHV3STCB"
        };

        firebase.initializeApp(firebaseConfig);

        let confirmationResult;

        const phoneInput = document.getElementById("phone");
        const otpInput = document.getElementById("otp");
        const statusBox = document.getElementById("otp-status");

        document.getElementById("send-otp-btn").addEventListener("click", function () {
            const phone = phoneInput.value;

            if (!phone.startsWith('+')) {
                alert("Please enter phone number in international format (e.g., +923001234567)");
                return;
            }

            if (!window.recaptchaVerifier) {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                    size: 'normal',
                    callback: function () {}
                });
                window.recaptchaVerifier.render();
            }

            firebase.auth().signInWithPhoneNumber(phone, window.recaptchaVerifier)
                .then(result => {
                    confirmationResult = result;
                    statusBox.innerText = "OTP sent to " + phone;
                })
                .catch(error => {
                    statusBox.innerText = "" + error.message;
                });
        });

        document.getElementById("verify-otp-btn").addEventListener("click", function () {
            const code = otpInput.value;

            if (!confirmationResult) {
                statusBox.innerText = "Please send the OTP first.";
                return;
            }

            confirmationResult.confirm(code)
                .then(result => {
                    statusBox.innerText = "OTP Verified. Redirecting...";
                    setTimeout(() => {
                        window.location.href = "/password/reset-phone"; // Adjust as needed
                    }, 2000);
                })
                .catch(error => {
                    statusBox.innerText = "Invalid OTP: " + error.message;
                });
        });
    });
</script>
@endsection
