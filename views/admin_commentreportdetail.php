<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Comment Report Detail</title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1">Comment Report Detail</h1>
                <div class="reported-comment">
                    <p class="report-content">Content: <?=$commentReport["content"]?></p>
                    <p class="report-content">Author: <?=$user["username"]?></p>
                    <p class="report-content">Report Subject: <?=$commentReport["name"]?></p>
                    <div class="form">
                        <form method="post" action="/admin_commentreportdetail/<?= $commentReport["comment_id"] ?>">
                            <button class="form-button" type="submit" name="dismiss">Dismiss Report</button>
                        </form>
                        <form method="post" action="/admin_commentreportdetail/<?= $commentReport["comment_id"] ?>">
                            <button class="form-white-button" type="submit" name="restrict_privileges">Restrict User</button>
                        </form>
                        <form method="post" action="/admin_commentreportdetail/<?= $commentReport["comment_id"] ?>">
                            <button class="form-red-button" type="submit" name="ban_user">Ban User</button>
                        </form>
                    </div>
                </div>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>
</body>
</html>