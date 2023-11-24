<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>

    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/menu.js"></script>
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
            <h1 class="heading-1">Create</h1>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' .$message. '</p>';
    }
?>
            <form class="form" method="POST" action="/create/" enctype=multipart/form-data>
                <div>
                    <input class="form-input" type="text" name="title" placeholder="Title" aria-label="Post Title" minlength="3" maxlength="50" required>
                </div>
                <div>
                    <textarea class="form-input" type="text" name="content" Placeholder="Content" aria-label="Post Content" cols="36" rows="6" minlength="10" maxlength="222" required></textarea>
                </div>
                <label class="heading-4" for="photo">Select a Photo</label>
                <div>
                    <input class="form-file" type="file" name="photo" id="photo" accept="<?= implode(",", $allowed_formats) ?>" required>
                </div>
                <div>
                    <input class="form-button" type="submit" value="Create Post" aria-label="Create Post" name="send">
                </div>
            </form>
        </div>
<?php
    require("templates/footer.php");
?>    </main>  
</body>
</html>