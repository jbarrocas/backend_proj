<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Accounts Reports</title>
    <script src="/js/admin_accountereports.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <h1>Deleted Accounts Reports</h1>
        <h2>Last Week Statistics</h2>
        <table>
            <tr>
                <th>Subject</th>
                <th data-total="<?= $numberOfRows ?>">Occurrences</th>
                <th>Percentage</th>
            </tr>
<?php
    foreach($weekStatistics as $weekStatistic) {
        echo '
            <tr>
                <td>' .$weekStatistic["name"]. '</td>
                <td data-count="' .$weekStatistic["count"]. '">' .$weekStatistic["count"]. '</td>
                <td name="percentage"></td>
            </tr>
        ';
    }
?>
            <tr>
                 <td>Total Deleted Accounts</td>
                 <td colspan="2"><?= $numberOfRows ?></td>   
            </tr>
        </table>
        <h2>Last Month Statistics</h2>
        <table>
            <tr>
                <th>Subject</th>
                <th data-total="<?= $numberOfRowsMonth ?>">Occurrences</th>
                <th>Percentage</th>
            </tr>
<?php
    foreach($monthStatistics as $monthStatistic) {
        echo '
            <tr>
                <td>' .$monthStatistic["name"]. '</td>
                <td data-count="' .$monthStatistic["count"]. '">' .$monthStatistic["count"]. '</td>
                <td name="percentageMonth"></td>
            </tr>
        ';
    }
?>
            <tr>
                 <td>Total Deleted Accounts</td>
                 <td colspan="2"><?= $numberOfRowsMonth ?></td>   
            </tr>
        </table>
        <h2>Last 100 Reports With Messages</h2>
        <div class="post-reports">
            <table>
                <tr>
                    <th>Report ID</th>
                    <th>Subject</th>
                    <th>Deleted At</th>
                </tr>
<?php
    foreach($reports as $report) {
        echo '
            <tr>
                <td>' .$report["delete_account_report_id"]. '</td>
                <td>' .$report["name"]. '</td>
                <td>' .$report["deleted_at"]. '</td>
                <td><a href="/admin_deletereportdetail/' .$report["delete_account_report_id"]. '">See Report Detail</a></td>
            </tr>
        ';
    }
?>
            </table>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>
</body>
</html>