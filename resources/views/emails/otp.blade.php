<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 40px 30px;
            text-align: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .logo svg {
            width: 40px;
            height: 40px;
            fill: white;
        }

        .header h1 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .content {
            padding: 50px 40px;
            text-align: center;
        }

        .greeting {
            font-size: 18px;
            color: #374151;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .otp-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 16px;
            padding: 30px;
            margin: 30px 0;
            border: 2px dashed #cbd5e1;
        }

        .otp-label {
            font-size: 14px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .otp-code {
            font-size: 36px;
            font-weight: 800;
            color: #4f46e5;
            font-family: 'Courier New', monospace;
            letter-spacing: 8px;
            margin: 15px 0;
            text-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .otp-validity {
            font-size: 14px;
            color: #ef4444;
            font-weight: 600;
            margin-top: 15px;
        }

        .security-notice {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 30px 0;
            border-radius: 8px;
            text-align: left;
        }

        .security-notice h4 {
            color: #92400e;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .security-notice p {
            color: #a16207;
            font-size: 14px;
            margin: 0;
            line-height: 1.5;
        }

        .footer {
            background: #f8fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .footer p {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            body { padding: 10px; }
            .content { padding: 30px 20px; }
            .otp-code { font-size: 28px; letter-spacing: 4px; }
            .header { padding: 30px 20px; }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <svg viewBox="0 0 24 24">
                    <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M10 17L6 13L7.41 11.59L10 14.17L16.59 7.58L18 9L10 17Z"/>
                </svg>
            </div>
            <h1>Account Verification</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                <strong>Hello!</strong><br>
                We received a request to verify your account. Please use the OTP code below to complete your verification.
            </div>

            <div class="otp-section">
                <div class="otp-label">Your Verification Code</div>
                <div class="otp-code">{{ $otp }}</div>
            </div>

            <div class="security-notice">
                <h4>🔒 Security Notice</h4>
                <p>
                    For your security, never share this code with anyone. Our team will never ask for your OTP code via phone, email, or any other communication method.
                </p>
            </div>

            <p style="color: #64748b; font-size: 16px; line-height: 1.6;">
                If you didn't request this verification, please ignore this email.
            </p>
        </div>

        <!-- Footer -->

    </div>
</body>
</html>
