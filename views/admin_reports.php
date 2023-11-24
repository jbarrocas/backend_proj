<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1">Admin Reports</h1>
            <div class="admin-reports">
                <table>
                    <tr>
                        <th class="th-admin">Report ID</th>
                        <th class="th-admin">Reported By</th>
                        <th class="th-admin">Reported At</th>
                        <th class="th-admin">Report Detail</th>
                    </tr>
<?php
    foreach($adminReports as $adminReport) {
        echo '
            <tr>
                <td class="td-admin">' .$adminReport["admin_report_id"]. '</td>
                <td class="td-admin">' .$adminReport["username"]. '</td>
                <td class="td-admin">' .$adminReport["created_at"]. '</td>
                <td class="td-admin"><a href="/admin_reportdetail/' .$adminReport["admin_report_id"]. '">See Report Detail</a></td>
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