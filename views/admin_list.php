<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Admins List</title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1">Admins List</h1>
<?php
    foreach($admins as $admin) {
        echo '
            <div class="user-detail">
                <p>Name: ' .$admin["first_name"]. " " .$admin["last_name"].'</p>
                <p>Username: ' .$admin["username"]. '</p>
                <p>Email: ' .$admin["email"]. '</p>
                <p>Country: ' .$admin["country"]. '</p>
                <a href="/admin_updateadminstatus/' .$admin["user_id"]. '"><div class="link-whiteButton">View Detail and Update Status</div></a>
            </div>
        ';
    }
?>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>