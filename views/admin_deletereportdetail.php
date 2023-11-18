<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Report Detail</title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <h1>Deleted Account Report Detail</h1>
        <div class="delete-report">
            <p>Subject: <?=$report["subject"]?></p>
            <p>Message: <?=$report["user_text"]?></p>
            <p>Deleted at: <?=$report["deleted_at"]?></p>
        </div>
    </main>
</body>
</html>