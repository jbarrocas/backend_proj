<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Admin Report Detail></title>
    <script src="/js/admin_reports.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1">Admin Report Detail - <?= $report["username"] ?></h1>
            <div class="report-container" name="report">
                <p>Message: <?=$report["admin_message"]?></p>
                <p>Reported by: <?=$report["username"]?></p>
                <form class="form" method="post" action="/admin_reportdetail/<?= $report["admin_report_id"] ?>" name="form">
                    <button class="form-button" type="submit" name="archive">Archive Report</button>
                </form>
            </div>
<?php
    if( isset($message) ) {
        echo '<p role="alert" id="successMessage">' . $message . '</p>';
    }
?>
            <a href="/admin_reports/"><div class="form-whiteButton">Back to Reports</div></a>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>
</body>
</html>