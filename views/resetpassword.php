<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Reset Password</title>
    <script src="/js/form_hide.js"></script>
</head>
<body>
    <main>
<?php
    if(isset($_SESSION["is_admin"]) || isset($_SESSION["is_super_admin"])) {
        require("templates/adminmenu.php");
    }
    else {
        require("templates/menu.php");
    }
?>
        <div class="page-content">
            <h1 class="heading-1">Reset your password</h1>
<?php
    if( isset($message)) {
        echo ' <p class="error-message" id="message" role="alert">' .$message.' </p>';
    }
?>       
            <form class="form" method="POST" action="/resetpassword/" name="form">
                <div>
                    <input class="form-input" type="email" name="email" placeholder="Email" required>
                </div>
                <div>
                    <button class="form-button" type="submit" name="reset_password">Receive Email to Reset Password</button>
                </div>
            </form>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>