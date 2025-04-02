<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 Forbidden</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.ico">
    <style type="text/css">
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .error-container {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
            position: relative;
            overflow: hidden;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #007bff;
            line-height: 1;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .error-message {
            font-size: 24px;
            color: #343a40;
            margin-bottom: 30px;
        }
        .error-description {
            color: #6c757d;
            margin-bottom: 30px;
        }
        .back-home {
            display: inline-block;
            padding: 12px 30px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-home:hover {
            background-color: #0056b3;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">403</div>
        <h1 class="error-message"><?php echo $heading; ?></h1>
        <p class="error-description"><?php echo $message; ?></p>
        <a href="<?php echo base_url(); ?>admin" class="back-home">Back to Dashboard</a>
    </div>
</body>
</html>