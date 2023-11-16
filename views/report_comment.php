<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Comment</title>
    <script src="/js/report.js"></script>
</head>
<body>
    <main>
<?php
    if(isset($_SESSION["is_admin"]) || isset($_SESSION["is_super_admin"])) {
        require("templates/adminmenu.php");
    }
    else {
        require("templates/menu.php");
    }
?>
        <h1>Report Comment</h1>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
?>
        <form method="POST" action="/report_comment/<?= $comment["comment_id"] ?>" name="form">
            <select class="report-select" name="subject" required>
<?php
    foreach($subjects as $subject) {

        echo '
            <option value="' .$subject["name"]. '">' .$subject["name"]. '</option>
        ';
    }
?>
            </select>
            <button type="submit" name="send">Report</button>
        </form>
    </main>    
</body>
</html>