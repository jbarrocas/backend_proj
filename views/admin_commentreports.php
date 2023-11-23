<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Comment Reports</title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1">Comment Reports</h1>
                <div class="comment-reports">
                    <table>
                        <tr>
                            <th>Comment ID</th>
                            <th>Subject</th>
                            <th>Reported By</th>
                            <th>Reported At</th>
                            <th>Report Detail</th>
                        </tr>
        <?php
            foreach($commentReports as $commentReport) {
                echo '
                    <tr">
                        <td>' .$commentReport["comment_id"]. '</td>
                        <td>' .$commentReport["name"]. '</td>
                        <td>' .$commentReport["username"]. '</td>
                        <td>' .$commentReport["reported_at"]. '</td>
                        <td><a href="/admin_commentreportdetail/' .$commentReport["comment_id"]. '">See Report Detail</a></td>
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