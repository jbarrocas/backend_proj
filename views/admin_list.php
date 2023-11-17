<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins List</title>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <h1>Admins List</h1>
<?php
    foreach($admins as $admin) {
        echo '
            <div>
                <p>Name: ' .$admin["first_name"]. " " .$admin["last_name"].'</p>
                <p>Username: ' .$admin["username"]. '</p>
                <p>Email: ' .$admin["email"]. '</p>
                <p>Country: ' .$admin["country"]. '</p>
                <div>
                    <a href="/admin_updateadminstatus/' .$admin["user_id"]. '">Update Status</a>
                </div>
            </div>
        ';
    }
?>
    </main>    
</body>
</html>