<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Report Detail</title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <h1>Post Report Detail</h1>
        <div class="reported-post">
            <figure>
                <img src="../images/posts/<?=$postReport["photo"]?>" alt="">
            </figure>
            <p>Title: <?=$postReport["title"]?></p>
            <p>Content: <?=$postReport["content"]?></p>
            <p>Author: <?=$user["username"]?></p>
            <p>Report Subject: <?=$postReport["subject"]?></p>
            <div class="action-buttons">
                <button type="button" name="dismiss">Dismiss</button>
                <button type="button" name="restrict_privileges">Restrict</button>
                <button type="button" name="ban_user">Ban</button>
            </div>            
        </div>
    </main>
</body>
</html>