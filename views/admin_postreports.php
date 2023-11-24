<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Post Reports</title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1">Post Reports</h1>
            <div class="post-reports">
                <table>
                    <tr>
                        <th class="th-user">Post ID</th>
                        <th class="th-user">Subject</th>
                        <th class="th-user">Reported By</th>
                        <th class="th-user">Reported At</th>
                        <th class="th-user">Report Detail</th>
                    </tr>
<?php
    foreach($postReports as $postReport) {
        echo '
            <tr>
                <td class="td-user">' .$postReport["post_id"]. '</td>
                <td class="td-user">' .$postReport["name"]. '</td>
                <td class="td-user">' .$postReport["username"]. '</td>
                <td class="td-user">' .$postReport["reported_at"]. '</td>
                <td class="td-user"><a href="/admin_postreportdetail/' .$postReport["post_id"]. '">See Report Detail</a></td>
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