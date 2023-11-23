<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Delete Account</title>
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
            <h1 class="heading-1">Delete Account</h1>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
?>
            <form class="form" method="POST" action="/deleteaccount/" name="form">
                <label for="subject">What's the reason?</label>
                <div>
                    <select class="form-input" name="subject_id" required>
<?php
    foreach($subjects as $subject) {

        echo '
            <option value="' .$subject["delete_account_subject_id"]. '">' .$subject["name"]. '</option>
        ';
    }
?>
                    </select>
                </div>
                <div>
                    <textarea class="form-input" name="delete_motive" id="motive" placeholder="Tell us why (optional)" cols="74" rows="3" minlength="10" maxlength="222"></textarea>
                </div>
                <div>
                    <button class="form-red-button" type="submit" name="delete">Delete</button>
                </div>
            </form>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>