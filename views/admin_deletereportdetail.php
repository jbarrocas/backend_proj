<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Report Detail</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1">Deleted Account Report Detail</h1>
            <div class="delete-report">
                <p>Subject: <?=$report["name"]?></p>
                <p>Message: <?=$report["user_text"]?></p>
                <p>Deleted at: <?=$report["deleted_at"]?></p>
            </div>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>
</body>
</html>