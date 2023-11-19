<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search User</title>
    <script src="/js/search.js"></script>
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
        <h1 id="heading">Search User</h1>
        <form action="/admin_search_user/" method="get" id="searchForm">           
            <input type="text" name="search" id="searchText" minlength="3" maxlength="30">
            <button type="submit" name="submit">Search</button>
        </form>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
    
    if( isset($users) ) {

        foreach($users as $user) {
            echo '
                <div>
                    <p>Name: ' .$user["first_name"]. " " .$user["last_name"].'</p>
                    <p>Username: ' .$user["username"]. '</p>
                    <p>Email: ' .$user["email"]. '</p>
                    <p>Country: ' .$user["country"]. '</p>
                    <div>
                        <a href="/admin_updateadminstatus/' .$user["user_id"]. '">Update Status</a>
                    </div>
                </div>
            ';
        }
    }
?>
    </main>    
</body>
</html>