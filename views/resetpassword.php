<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <main>
<?php
    if(isset($_SESSION["admin_id"])) {
        require("templates/adminmenu.php");
    }
    else {
        require("templates/menu.php");
    }
?>
        <h1>Reset your password</h1>
<?php
    if( isset($message)) {
        echo ' <p role="alert">' .$message.' </p>';
    }
?>       
        <form method="POST" action="/resetpassword/">
            <input class="reset-email-input" type="email" name="email" placeholder="Email" required>
            <button type="submit" name="reset_password">Receive Email to Reset Password</button>
        </form>
    </main>    
</body>
</html>