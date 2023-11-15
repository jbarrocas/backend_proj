<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <!-- <script src="/js/report.js"></script> -->
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
        <h1>Delete Account</h1>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
?>
        <form class="" method="POST" action="/deleteaccount/" name="form">
            <label for="subject">What's the reason?</label>
            <select class="report-select" name="subject" required>
<?php
    foreach($subjects as $subject) {

        echo '
            <option value="' .$subject["name"]. '">' .$subject["name"]. '</option>
        ';
    }
?>
            </select>
            <textarea name="delete_motive" id="motive" placeholder="Tell us why (optional)" cols="74" rows="3" minlength="10" maxlength="222"></textarea>
            <button type="submit" name="send">Delete</button>
        </form>
    </main>    
</body>
</html>