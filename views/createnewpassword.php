<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
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
        <h1>Create new password</h1>
<?php
    if( isset($message)) {
        echo ' <p role="alert">' .$message.' </p>';
    }
?>       
        <form method="POST" action="/createnewpassword/?token=<?= $_GET["token"] ?>&email=<?= $_GET["email"] ?>">
            <input class="register-input" type="password" name="new_password" placeholder="New Password" required minlength="8" maxlength="1000">
            <input class="register-input" type="password" name="new_password_confirm" placeholder="New Password Confirmation" required minlength="8" maxlength="1000">
            <button type="submit" name="createpassword">Create new password</button>
        </form>
    </main>    
</body>
</html>