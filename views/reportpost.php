<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Post</title>
    <script src="/js/reportpost.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        <h1>Report Post</h1>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message.' </p>';
    }
?>
        <form method="POST" action="/reportpost/<?= $post["post_id"] ?>" name="form">
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