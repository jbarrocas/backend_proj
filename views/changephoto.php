<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Photo</title>
    <script src="/js/validatefilesize.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        <h1>Change your profile photo</h1>
        <img src="<?=$user["photo"]?>" alt="">
        <form method="POST" action="/changephoto/" enctype=multipart/form-data>
            <input type="file" name="photo" id="photo" accept="<?= implode(",", $allowed_formats) ?>" required>
            <button type="submit" name="send" onclick="validateFileSize()">Submit Photo</button>
        </form>
    </main>    
</body>
</html>