<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Post</title>
    <link rel="stylesheet" href="/css/main.css">
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
        <div class="page-content">
            <h1 class="heading-1">Report Post</h1>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
?>
            <form class="form" method="POST" action="/report_post/<?= $post["post_id"] ?>" name="form">
                <div>
                    <select class="form-input report-select" name="subject" required>
<?php
    foreach($subjects as $subject) {

        echo '
            <option value="' .$subject["report_subject_id"]. '">' .$subject["name"]. '</option>
        ';
    }
?>
                    </select>
                </div>
                <div>
                    <button class="form-red-button" type="submit" name="send">Report</button>
                </div>                
            </form>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>
</body>
</html>