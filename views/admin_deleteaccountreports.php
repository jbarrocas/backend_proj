<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Accounts Reports</title>
    
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/admin_accountereports.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1">Deleted Accounts Reports</h1>
            <h2 class="heading-2">Last Week Statistics</h2>
            <table>
                <tr>
                    <th class="th-admin-3">Subject</th>
                    <th class="th-admin-3" data-total="<?= $numberOfRows ?>">Occurrences</th>
                    <th class="th-admin-3">Percentage</th>
                </tr>
<?php
    foreach($weekStatistics as $weekStatistic) {
        echo '
            <tr>
                <td class="td-admin-3">' .$weekStatistic["name"]. '</td>
                <td class="td-admin-3" data-count="' .$weekStatistic["count"]. '">' .$weekStatistic["count"]. '</td>
                <td class="td-admin-3" name="percentage"></td>
            </tr>
        ';
    }
?>
                <tr>
                    <td class="td-admin-3">Total Deleted Accounts</td>
                    <td class="td-admin-3" colspan="2"><?= $numberOfRows ?></td>   
                </tr>
            </table>
            <h2 class="heading-2">Last Month Statistics</h2>
            <table>
                <tr>
                    <th class="th-admin-3">Subject</th>
                    <th class="th-admin-3" data-total="<?= $numberOfRowsMonth ?>">Occurrences</th>
                    <th class="th-admin-3">Percentage</th>
                </tr>
<?php
    foreach($monthStatistics as $monthStatistic) {
        echo '
            <tr>
                <td class="td-admin-3">' .$monthStatistic["name"]. '</td>
                <td class="td-admin-3" data-count="' .$monthStatistic["count"]. '">' .$monthStatistic["count"]. '</td>
                <td class="td-admin-3" name="percentageMonth"></td>
            </tr>
        ';
    }
?>
                <tr>
                    <td class="td-admin-3">Total Deleted Accounts</td>
                    <td class="td-admin-3" colspan="2"><?= $numberOfRowsMonth ?></td>   
                </tr>
            </table>
            <h2 class="heading-2">Last 100 Reports With Messages</h2>
            <div class="post-reports">
                <table>
                    <tr>
                        <th class="th-admin">Report ID</th>
                        <th class="th-admin">Subject</th>
                        <th class="th-admin">Deleted At</th>
                        <th class="th-admin">See Detail</th>
                    </tr>
<?php
    foreach($reports as $report) {
        echo '
            <tr>
                <td class="td-admin">' .$report["delete_account_report_id"]. '</td>
                <td class="td-admin">' .$report["name"]. '</td>
                <td class="td-admin">' .$report["deleted_at"]. '</td>
                <td class="td-admin"><a href="/admin_deletereportdetail/' .$report["delete_account_report_id"]. '">See Report Detail</a></td>
            </tr>
        ';
    }
?>
                </table>
            </div>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>
</body>
</html>