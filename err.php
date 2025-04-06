<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Username Already Exists</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="form-section">
        <h1>Username Already Exists</h1>
        
        <p class="error-message">❌ The username you entered already exists! Please choose another one.</p>

        <?php
            $form_type = isset($_GET['form_type']) ? $_GET['form_type'] : 'signup';
        ?>

        <form action="<?php 
            if ($form_type === 'signup') {
                echo 'signup.html'; 
            } elseif ($form_type === 'add_user') {
                echo 'dashboard.php'; 
            }
        ?>" method="get">
            <button type="submit" class="login-btn">Go Back</button>
        </form>
    </div>

</body>
</html>
