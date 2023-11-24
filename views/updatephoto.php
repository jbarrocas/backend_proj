<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Photo</title>
    
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
            <h1 class="heading-1">Change your profile photo</h1>
                <img src="/images/users/<?=$user["photo"]?>" alt="">
<?php
    if( isset($message)) {
        echo ' <p role="alert">' .$message.' </p>';
    }
?>
                <form class="form" method="POST" action="/updatephoto/" enctype=multipart/form-data>
                    <label class="heading-4" for="photo">Select a Photo</label>
                    <div>
                        <input class="form-file" type="file" name="photo" id="photo" accept="<?= implode(",", $allowed_formats) ?>" required>
                    </div>
                    <div>
                        <button class="form-button" type="submit" name="send">Update Photo</button>
                    </div>
                </form>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>