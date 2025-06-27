@extends('layouts.app')

@section('content')
<div class="register-card">
    <div class="register-header">{{ __('Reset Password via Phone') }}</div>

    <form id="otp-form">
        <div class="mb-3">
            <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
            <input id="phone" type="text"
                   class="form-control"
                   name="phone"
                   placeholder="+923001234567"
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

    <!-- ✅ Firebase SDK -->
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>

    <!-- ✅ OTP Logic -->
    <script>
        console.log("✅ Firebase OTP script loaded");

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

            let confirmationResult;
            const phoneInput = document.getElementById("phone");
            const otpInput = document.getElementById("otp");
            const statusBox = document.getElementById("otp-status");

            // ✅ Setup reCAPTCHA
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                size: 'normal',
                callback: function () {
                    console.log("✅ reCAPTCHA verified");
                },
                'expired-callback': function () {
                    console.warn("⚠️ reCAPTCHA expired");
                }
            });

            recaptchaVerifier.render().then(function (widgetId) {
                window.recaptchaWidgetId = widgetId;
            });

            // ✅ Send OTP
            document.getElementById("send-otp-btn").addEventListener("click", function () {
                const phone = phoneInput.value.trim();
                const phoneRegex = /^\+[1-9]\d{7,14}$/; // E.164 format

                if (!phoneRegex.test(phone)) {
                    alert("❌ Invalid phone format. Example: +923001234567");
                    return;
                }

                firebase.auth().signInWithPhoneNumber(phone, window.recaptchaVerifier)
                    .then(result => {
                        confirmationResult = result;
                        statusBox.innerText = "✅ OTP sent to " + phone;
                    })
                    .catch(error => {
                        console.error("❌ OTP send failed:", error);
                        statusBox.innerText = "❌ " + error.message;
                    });
            });

            // ✅ Verify OTP
            document.getElementById("verify-otp-btn").addEventListener("click", function () {
                const code = otpInput.value.trim();

                if (!confirmationResult) {
                    statusBox.innerText = "❌ Please send the OTP first.";
                    return;
                }

                confirmationResult.confirm(code)
                    .then(result => {
                        statusBox.innerText = "✅ OTP Verified. Logging in...";

                        const formattedPhone = phoneInput.value.replace('+', '');

                        fetch("/otp-verified-login", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content')
                            },
                            body: JSON.stringify({ phone_number: formattedPhone })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.redirect) {
                                    statusBox.innerText = "✅ Logged in. Redirecting...";
                                    setTimeout(() => {
                                        window.location.href = data.redirect;
                                    }, 1000);
                                } else {
                                    statusBox.innerText = "⚠️ Login succeeded, but no redirect found.";
                                }
                            })
                            .catch(error => {
                                console.error("❌ Server error:", error);
                                statusBox.innerText = "❌ " + error.message;
                            });
                    })
                    .catch(error => {
                        statusBox.innerText = "❌ Invalid OTP: " + error.message;
                    });
            });
        });
    </script>
</div>
@endsection
