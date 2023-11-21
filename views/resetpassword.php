<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h1>Reset your password</h1>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message.' </p>';
    }
?>       
        <form method="POST" action="/resetpassword/" name="form">
            <input class="reset-email-input" type="email" name="email" placeholder="Email" required>
            <button type="submit" name="reset_password">Receive Email to Reset Password</button>
        </form>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>