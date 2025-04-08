<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        .error-container {
            text-align: center;
            padding: 40px;
            margin-top: 100px;
        }
        .error-code {
            font-size: 120px;
            color: #dc3545;
            margin: 0;
        }
        .error-message {
            font-size: 24px;
            color: #6c757d;
            margin: 20px 0;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-code">404</h1>
        <p class="error-message">Oops! The page you're looking for doesn't exist.</p>
        <a href="<?= base_url('admin/login') ?>" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>