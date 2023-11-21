<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Report Detail</title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <h1>Comment Report Detail</h1>
        <div class="reported-comment">
            <p>Content: <?=$commentReport["content"]?></p>
            <p>Author: <?=$user["username"]?></p>
            <p>Report Subject: <?=$commentReport["name"]?></p>
            <div class="form-container">
                <form method="post" action="/admin_commentreportdetail/<?= $commentReport["comment_id"] ?>">
                    <button type="submit" name="dismiss">Dismiss Report</button>
                </form>
                <form method="post" action="/admin_commentreportdetail/<?= $commentReport["comment_id"] ?>">
                    <button type="submit" name="restrict_privileges">Restrict User</button>
                </form>
                <form method="post" action="/admin_commentreportdetail/<?= $commentReport["comment_id"] ?>">
                    <button type="submit" name="ban_user">Ban User</button>
                </form>
            </div>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>
</body>
</html>