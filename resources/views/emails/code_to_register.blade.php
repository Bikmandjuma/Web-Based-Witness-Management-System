<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration Code</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            width: 100%;
            padding: 20px 0;
            display: flex;
            justify-content: center;
        }
        .email-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 500px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px 20px;
            text-align: center;
        }
        .email-card h2 {
            color: #333333;
            margin-bottom: 20px;
        }
        .email-card p {
            color: #555555;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .code-container {
            background-color: #f0f4ff;
            border: 1px dashed #5784f5;
            border-radius: 8px;
            padding: 15px;
            display: inline-block;
            font-size: 24px;
            font-weight: bold;
            color: #1d3fff;
            letter-spacing: 4px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-card">
            <h2>Welcome to Job Sphere Rwanda!</h2>
            <p>We have received your request to register a new account. Use the code below to complete your registration:</p>
            
            <div class="code-container">
                {{ $code }}
            </div>

            <p class="footer">This code is valid for one hour from the time it was sent.</p>
        </div>
    </div>
</body>
</html>
