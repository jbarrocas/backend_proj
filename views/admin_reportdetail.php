<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report Detail></title>
    <script src="/js/admin_reports.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <h1>Admin Report Detail - <?= $report["username"] ?></h1>
        <div class="report-container" name="report">
            <p>Message: <?=$report["admin_message"]?></p>
            <p>Author: <?=$report["username"]?></p>
            <form method="post" action="/admin_reportdetail/<?= $report["admin_report_id"] ?>" name="form">
                <button type="submit" name="archive">Archive Report</button>
            </form>
        </div>
<?php
    if( isset($message) ) {
        echo '<p role="alert" id="successMessage">' . $message . '</p>';
    }
?>
        <div><a href="/admin_reports/">Back to Reports</a></div>
<?php
    require("templates/footer.php");
?>
    </main>
</body>
</html>