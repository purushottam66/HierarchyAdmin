<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
        }
        .container {
            position: relative;
            padding: 20px;
        }
        .lock {
            font-size: 80px;
            animation: shake 0.5s infinite alternate;
        }
        @keyframes shake {
            from {
                transform: rotate(-5deg);
            }
            to {
                transform: rotate(5deg);
            }
        }
        .message {
            font-size: 24px;
            margin-top: 10px;
        }
        .button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            background: white;
            color: #ff4b2b;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 5px;
        }
        .button:hover {
            background: #ff4b2b;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="lock">🔒</div>
        <div class="message">Access Denied! You do not have permission to view this page.</div>
    </div>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
