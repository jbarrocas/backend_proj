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
                        <th>Post ID</th>
                        <th>Subject</th>
                        <th>Reported By</th>
                        <th>Reported At</th>
                        <th>Report Detail</th>
                    </tr>
<?php
    foreach($postReports as $postReport) {
        echo '
            <tr>
                <td>' .$postReport["post_id"]. '</td>
                <td>' .$postReport["name"]. '</td>
                <td>' .$postReport["username"]. '</td>
                <td>' .$postReport["reported_at"]. '</td>
                <td><a href="/admin_postreportdetail/' .$postReport["post_id"]. '">See Report Detail</a></td>
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