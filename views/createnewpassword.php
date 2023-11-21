<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
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
        <h1>Create new password</h1>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message.' </p>';
    }
?>       
        <form method="POST" action="/createnewpassword/?token=<?= $_GET["token"] ?>&email=<?= $_GET["email"] ?>" name="form">
            <input class="register-input" type="password" name="new_password" placeholder="New Password" required minlength="8" maxlength="1000">
            <input class="register-input" type="password" name="new_password_confirm" placeholder="New Password Confirmation" required minlength="8" maxlength="1000">
            <button type="submit" name="createpassword">Create new password</button>
        </form>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>