<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>

    <link rel="stylesheet" href="/css/main.css">
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
            <h1 class="heading-1">Create a new password</h1>
        <?php
            if( isset($message)) {
                echo ' <p class="error-message" id="message" role="alert">' .$message.' </p>';
            }
        ?>       
            <form class="form" method="POST" action="/createnewpassword/?token=<?= $_GET["token"] ?>&email=<?= $_GET["email"] ?>" name="form">
            <div>
                <input class="form-input" type="password" name="new_password" placeholder="New Password" aria-label="New Password" required minlength="8" maxlength="1000">
            </div>
            <div>
                <input class="form-input" type="password" name="new_password_confirm" placeholder="New Password Confirmation" aria-label="New Password Confirmation" required minlength="8" maxlength="1000">
            </div>
            <div>
                <button class="form-button" type="submit" name="createpassword">Create new password</button>
            </div>
            </form>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>