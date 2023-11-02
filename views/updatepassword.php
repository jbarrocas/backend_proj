<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Pssword</title>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        <h1>Change your password</h1>
<?php
    if( isset($message)) {
        echo ' <p role="alert">' .$message.' </p>';
    }
?>       
        <form method="POST" action="/updatepassword/">
            <input class="register-input" type="password" name="old_password" placeholder="Old Password" required minlength="8" maxlength="1000">
            <input class="register-input" type="password" name="new_password" placeholder="New Password" required minlength="8" maxlength="1000">
            <input class="register-input" type="password" name="new_password_confirm" placeholder="New Password Confirmation" required minlength="8" maxlength="1000">
            <button type="submit" name="send">Change Password</button>
        </form>
    </main>    
</body>
</html>