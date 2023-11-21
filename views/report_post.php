<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Post</title>
    <script src="/js/form_hide.js"></script>
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
        <h1>Report Post</h1>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
?>
        <form class="" method="POST" action="/report_post/<?= $post["post_id"] ?>" name="form">
            <select class="report-select" name="subject" required>
<?php
    foreach($subjects as $subject) {

        echo '
            <option value="' .$subject["report_subject_id"]. '">' .$subject["name"]. '</option>
        ';
    }
?>
            </select>
            <button type="submit" name="send">Report</button>
        </form>
    </main>    
</body>
</html>