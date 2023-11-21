<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
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
        <div class="create-post-container">
            <h1>Create</h1>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' .$message. '</p>';
    }
?>
            <form method="POST" action="/create/" enctype=multipart/form-data>
                <input type="text" name="title" placeholder="Title" minlength="3" maxlength="50" required>
                <input type="text" name="content" Placeholder="Content" minlength="10" maxlength="222" required>
                <input type="file" name="photo" id="photo" accept="<?= implode(",", $allowed_formats) ?>" required>
                <input type="submit" value="post" name="send">
            </form>
        </div>
<?php
    require("templates/footer.php");
?>    </main>  
</body>
</html>