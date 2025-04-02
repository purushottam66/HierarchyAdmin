<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Session Expired</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .session-expired {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 90%;
        }
        .session-expired img {
            width: 120px;
            margin-bottom: 1.5rem;
        }
        .btn-login {
            background-color: #0d6efd;
            color: white;
            padding: 10px 30px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
            transition: background-color 0.3s;
        }
        .btn-login:hover {
            background-color: #0b5ed7;
            color: white;
        }
    </style>
</head>
<body>
    <div class="session-expired">
        <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logo">
        <h2 style="color: #dc3545;">Session Expired!</h2>
        <p style="margin: 1rem 0;">Your session has expired. Please login again for security reasons.</p>
        <a href="<?php echo base_url('login'); ?>" class="btn-login">Login Again</a>
    </div>
</body>
</html>