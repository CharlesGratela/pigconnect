<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your PigConnect Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        
        .logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .alert-message {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        
        .alert-message h2 {
            color: #dc2626;
            margin: 0 0 10px;
            font-size: 20px;
        }
        
        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 25px 0;
            transition: transform 0.2s;
        }
        
        .reset-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.3);
        }
        
        .security-tips {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 30px 0;
        }
        
        .tip {
            text-align: center;
            padding: 20px;
            background: #fefefe;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        
        .tip-icon {
            width: 40px;
            height: 40px;
            background: #dc2626;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }
        
        .security-note {
            background: #fef3cd;
            border: 1px solid #fbbf24;
            padding: 15px;
            border-radius: 6px;
            margin: 25px 0;
            font-size: 14px;
        }
        
        .footer {
            background: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        
        .footer a {
            color: #dc2626;
            text-decoration: none;
        }
        
        @media (max-width: 600px) {
            .email-container {
                margin: 20px;
                border-radius: 8px;
            }
            
            .header, .content {
                padding: 30px 20px;
            }
            
            .security-tips {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">🔒</div>
            <h1>Password Reset Request</h1>
            <p>Secure your PigConnect account with a new password</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="alert-message">
                <h2>Hello {{ $user->name }}! 🛡️</h2>
                <p>We received a request to reset the password for your PigConnect account ({{ $user->email }}). If you made this request, click the button below to set a new password.</p>
            </div>
            
            <p><strong>Important:</strong> If you didn't request a password reset, please ignore this email. Your account remains secure and no changes have been made.</p>
            
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="reset-button">
                    🔑 Reset My Password
                </a>
            </div>
            
            <div class="security-tips">
                <div class="tip">
                    <div class="tip-icon">🕒</div>
                    <h3>Act Quickly</h3>
                    <p>This link expires in 60 minutes for your security.</p>
                </div>
                <div class="tip">
                    <div class="tip-icon">💪</div>
                    <h3>Strong Password</h3>
                    <p>Use a mix of letters, numbers, and symbols.</p>
                </div>
                <div class="tip">
                    <div class="tip-icon">🔐</div>
                    <h3>Stay Secure</h3>
                    <p>Never share your password with anyone.</p>
                </div>
                <div class="tip">
                    <div class="tip-icon">📱</div>
                    <h3>Unique Passwords</h3>
                    <p>Use a different password for each account.</p>
                </div>
            </div>
            
            <div class="security-note">
                <strong>🔐 Security Notice:</strong> This password reset link will expire in 60 minutes. If you continue to have trouble accessing your account, please contact our support team.
            </div>
            
            <p>If the button above doesn't work, you can copy and paste this link into your browser:</p>
            <p style="word-break: break-all; color: #6b7280; font-size: 14px; background: #f9fafb; padding: 10px; border-radius: 4px;">
                {{ $resetUrl }}
            </p>
            
            <p>Having trouble? Our support team is here to help farmers like you stay connected and secure.</p>
            
            <p style="margin-top: 30px;">
                <strong>Stay Safe & Happy Farming!</strong><br>
                The PigConnect Security Team 🛡️
            </p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>PigConnect</strong> - Secure Farm Management Solutions</p>
            <p>
                <a href="{{ config('app.url') }}">Visit Website</a> |
                <a href="{{ config('app.url') }}/support">Get Support</a> |
                <a href="{{ config('app.url') }}/privacy">Privacy Policy</a>
            </p>
            <p>This email was sent to {{ $user->email }}. If you have security concerns, contact us immediately at security@pigconnect.com</p>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                Reset Token: {{ substr($token, 0, 8) }}... (for verification purposes)
            </p>
        </div>
    </div>
</body>
</html> 