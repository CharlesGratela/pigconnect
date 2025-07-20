<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your PigConnect Account</title>
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
            background: linear-gradient(135deg, #c58a61 0%, #8b5a3c 100%);
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
        
        .welcome-message {
            background: #f0f8f4;
            border-left: 4px solid #10b981;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        
        .welcome-message h2 {
            color: #065f46;
            margin: 0 0 10px;
            font-size: 20px;
        }
        
        .verify-button {
            display: inline-block;
            background: linear-gradient(135deg, #c58a61 0%, #8b5a3c 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 25px 0;
            transition: transform 0.2s;
        }
        
        .verify-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(197, 138, 97, 0.3);
        }
        
        .features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 30px 0;
        }
        
        .feature {
            text-align: center;
            padding: 20px;
            background: #fefefe;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        
        .feature-icon {
            width: 40px;
            height: 40px;
            background: #c58a61;
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
            color: #c58a61;
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
            
            .features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">🐷</div>
            <h1>Welcome to PigConnect!</h1>
            <p>Your Gateway to Modern Pig Farming Excellence</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="welcome-message">
                <h2>Hello {{ $user->name }}! 👋</h2>
                <p>Thank you for joining the PigConnect community! We're excited to have you on board as we revolutionize pig farming through technology and connection.</p>
            </div>
            
            <p>To get started with your PigConnect account and access all our farming management tools, please verify your email address by clicking the button below:</p>
            
            <div style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="verify-button">
                    ✅ Verify My Email Address
                </a>
            </div>
            
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">📊</div>
                    <h3>Farm Analytics</h3>
                    <p>Track your pigs' growth, health, and performance with detailed insights.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🌱</div>
                    <h3>Feed Management</h3>
                    <p>Optimize feeding schedules and nutrition for better results.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">💰</div>
                    <h3>Market Connect</h3>
                    <p>Connect with buyers and sellers in your local farming community.</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🏥</div>
                    <h3>Health Tracking</h3>
                    <p>Monitor breeding records and health status of your livestock.</p>
                </div>
            </div>
            
            <div class="security-note">
                <strong>🔐 Security Note:</strong> This verification link will expire in 60 minutes for your account security. If you didn't create a PigConnect account, please ignore this email.
            </div>
            
            <p>If the button above doesn't work, you can copy and paste this link into your browser:</p>
            <p style="word-break: break-all; color: #6b7280; font-size: 14px; background: #f9fafb; padding: 10px; border-radius: 4px;">
                {{ $verificationUrl }}
            </p>
            
            <p>Questions? Our farming community is here to help! Reach out to us anytime.</p>
            
            <p style="margin-top: 30px;">
                <strong>Happy Farming!</strong><br>
                The PigConnect Team 🚜
            </p>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>PigConnect</strong> - Connecting Farmers, Elevating Agriculture</p>
            <p>
                <a href="{{ config('app.url') }}">Visit Website</a> |
                <a href="{{ config('app.url') }}/support">Get Support</a> |
                <a href="{{ config('app.url') }}/privacy">Privacy Policy</a>
            </p>
            <p>This email was sent to {{ $user->email }}. If you have any questions, contact us at support@pigconnect.com</p>
        </div>
    </div>
</body>
</html> 