<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Photo</title>
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
        <h1>Change your profile photo</h1>
        <img src="/images/users/<?=$user["photo"]?>" alt="">
<?php
    if( isset($message)) {
        echo ' <p role="alert">' .$message.' </p>';
    }
?>
        <form method="POST" action="/updatephoto/" enctype=multipart/form-data>
            <input type="file" name="photo" id="photo" accept="<?= implode(",", $allowed_formats) ?>" required>
            <button type="submit" name="send">Update Photo</button>
        </form>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>