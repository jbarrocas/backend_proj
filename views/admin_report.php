<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Report</title>
    <script src="/js/report.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <h1 id="heading">Admin Report</h1>
        <form action="/admin_report/" method="POST" id="reportForm" name="form">
            <div>
                <textarea type="text" name="adminMessage" id="adminMessage" rows="10" cols="100" minlength="3" maxlength="1000" required></textarea>
            </div>
            <button type="submit" name="submit">Send Your Report</button>
        </form>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
?>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>