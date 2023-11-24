<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>

    <link rel="stylesheet" href="/css/main.css">
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
            <h1 class="heading-1">Update your password</h1>
<?php
    if( isset($message)) {
        echo ' <p role="alert">' .$message.' </p>';
    }
?>
            <form class="form" method="POST" action="/updatepassword/">
                <div>
                    <input class="form-input" type="password" name="old_password" placeholder="Old Password" aria-label="Old Password" required minlength="8" maxlength="1000">
                </div>
                <div>
                    <input class="form-input" type="password" name="new_password" placeholder="New Password" aria-label="New Password" required minlength="8" maxlength="1000">
                </div>
                <div>
                    <input class="form-input" type="password" name="new_password_confirm" placeholder="New Password Confirmation" aria-label="New Password Confirmation" required minlength="8" maxlength="1000">
                </div>
                <div>
                    <button class="form-button" type="submit" name="send">Update Password</button>
                </div>
            </form>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>