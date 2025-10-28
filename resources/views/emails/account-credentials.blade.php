<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your USTP Graduate Tracking System Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #1e40af;
        }
        .logo {
            background-color: #1e40af;
            color: white;
            padding: 15px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 15px;
        }
        .credentials {
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .credential-item {
            margin: 10px 0;
            padding: 10px;
            background-color: #ffffff;
            border-radius: 5px;
            border-left: 4px solid #1e40af;
        }
        .label {
            font-weight: bold;
            color: #1e40af;
        }
        .value {
            font-family: monospace;
            background-color: #f1f5f9;
            padding: 5px 10px;
            border-radius: 3px;
            margin-top: 5px;
            display: inline-block;
        }
        .button {
            display: inline-block;
            background-color: #1e40af;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #1e3a8a;
        }
        .warning {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; padding: 15px 30px; border-radius: 10px; display: inline-block; font-family: Arial, sans-serif;">
                        <h1 style="margin: 0; font-size: 28px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">USTP</h1>
                        <p style="margin: 5px 0 0 0; font-size: 12px; opacity: 0.9;">University of Science and Technology of Southern Philippines</p>
                    </div>
                </div>
                <p style="margin: 5px 0 0 0; font-size: 14px;">GRADUATE TRACKING SYSTEM</p>
            </div>
            <h2 style="color: #1e40af; margin: 0;">Welcome to Your Account!</h2>
        </div>

        <p>Dear <strong>{{ $user->name }}</strong>,</p>

        <p>Your account has been successfully created for the <strong>University of Science and Technology of Southern Philippines Balubal Campus Graduate Tracking System</strong>.</p>

        <div class="credentials">
            <h3 style="color: #1e40af; margin-top: 0;">Your Login Credentials</h3>
            
            <div class="credential-item">
                <div class="label">Email Address:</div>
                <div class="value">{{ $user->email }}</div>
            </div>
            
            <div class="credential-item">
                <div class="label">Password:</div>
                <div class="value">{{ $password }}</div>
            </div>
            
            <div class="credential-item">
                <div class="label">Role:</div>
                <div class="value">{{ ucfirst($user->role) }}</div>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="{{ $loginUrl }}" class="button">Login to Your Account</a>
        </div>

        <div class="warning">
            <h4 style="color: #92400e; margin-top: 0;">⚠️ Important Security Notice</h4>
            <p style="margin-bottom: 0;">For your security, please change your password after your first login. You can do this by going to your profile settings once you're logged in.</p>
        </div>

        <h3 style="color: #1e40af;">What You Can Do:</h3>
        <ul>
            @if($user->role === 'graduate')
                <li>Update your personal and academic information</li>
                <li>Track your employment status and career progress</li>
                <li>Search and apply for job opportunities</li>
                <li>Generate and download your resume</li>
                <li>View your graduation and verification status</li>
            @elseif($user->role === 'staff')
                <li>Manage graduate records and information</li>
                <li>Post job opportunities for graduates</li>
                <li>Generate career support reports</li>
                <li>Monitor alumni activities</li>
            @elseif($user->role === 'admin')
                <li>Manage all system users and accounts</li>
                <li>Review and approve job postings</li>
                <li>Monitor system data and generate reports</li>
                <li>Maintain system security and backups</li>
            @endif
        </ul>

        <p>If you have any questions or need assistance, please don't hesitate to contact the system administrator.</p>

        <div class="footer">
            <p><strong>University of Science and Technology of Southern Philippines</strong><br>
            Balubal Campus<br>
            Graduate Tracking System</p>
            <p style="font-size: 12px; color: #9ca3af;">
                This is an automated message. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
