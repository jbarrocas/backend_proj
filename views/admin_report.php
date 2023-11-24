<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report</title>

    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/report.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1" id="heading">Admin Report</h1>
                <form class="form" action="/admin_report/" method="POST" id="reportForm" name="form">
                    <div>
                        <textarea class="form-input" type="text" name="adminMessage" id="adminMessage" aria-label="Message" rows="10" cols="100" minlength="3" maxlength="1000" required></textarea>
                    </div>
                    <button class="form-button" type="submit" name="submit">Send Your Report</button>
                </form>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
?>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>