<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        .error-container {
            text-align: center;
            padding: 50px 20px;
            margin-top: 100px;
        }
        .error-code {
            font-size: 120px;
            color: #dc3545;
            margin: 0;
            font-weight: bold;
        }
        .error-message {
            font-size: 24px;
            color: #6c757d;
            margin: 20px 0;
        }
        .user-info {
            margin-bottom: 30px;
            color: #28a745;
        }
        .back-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 16px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <?php if(isset($user_name)): ?>
            <div class="user-info">Welcome, <?php echo htmlspecialchars($user_name); ?></div>
        <?php endif; ?>
        <h1 class="error-code">404</h1>
        <h2 class="error-message">Page Not Found</h2>
        <p>The page you are looking for does not exist or has been moved.</p>
        <a href="<?php echo base_url(); ?>" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>