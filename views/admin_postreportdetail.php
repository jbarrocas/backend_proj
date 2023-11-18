<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Report Detail - <?= $postReport["title"] ?></title>
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
            <div class="form-container">
                <form method="post" action="/admin_postreportdetail/<?= $postReport["post_id"] ?>">
                    <button type="submit" name="dismiss">Dismiss Report</button>
                </form>
                <form method="post" action="/admin_postreportdetail/<?= $postReport["post_id"] ?>">
                    <button type="submit" name="restrict_privileges">Restrict User</button>
                </form>
                <form method="post" action="/admin_postreportdetail/<?= $postReport["post_id"] ?>">
                    <button type="submit" name="ban_user">Ban User</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>