<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports</title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <h1>Admin Reports</h1>
        <div class="admin-reports">
            <table>
                <tr>
                    <th>Report ID</th>
                    <th>Reported By</th>
                    <th>Reported At</th>
                    <th>Report Detail</th>
                </tr>
<?php
    foreach($adminReports as $adminReport) {
        echo '
            <tr>
                <td>' .$adminReport["admin_report_id"]. '</td>
                <td>' .$adminReport["username"]. '</td>
                <td>' .$adminReport["created_at"]. '</td>
                <td><a href="/admin_reportdetail/' .$adminReport["admin_report_id"]. '">See Report Detail</a></td>
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