<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Reports</title>

    <link rel="stylesheet" href="/css/main.css">
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
                            <th class="th-user">Comment ID</th>
                            <th class="th-user">Subject</th>
                            <th class="th-user">Reported By</th>
                            <th class="th-user">Reported At</th>
                            <th class="th-user">Report Detail</th>
                        </tr>
        <?php
            foreach($commentReports as $commentReport) {
                echo '
                    <tr">
                        <td class="td-user">' .$commentReport["comment_id"]. '</td>
                        <td class="td-user">' .$commentReport["name"]. '</td>
                        <td class="td-user">' .$commentReport["username"]. '</td>
                        <td class="td-user">' .$commentReport["reported_at"]. '</td>
                        <td class="td-user"><a href="/admin_commentreportdetail/' .$commentReport["comment_id"]. '">See Report Detail</a></td>
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