<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <title>Search User</title>
    <script src="/js/search.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/adminmenu.php");
?>
        <div class="page-content">
            <h1 class="heading-1" id="heading">Search User</h1>
            <form class="form" action="/admin_search_user/" method="get" id="searchForm">
                <div>
                    <input class="form-input" type="text" name="search" id="searchText" minlength="3" maxlength="30">
                </div>
                <div>
                    <button class="form-button" type="submit" name="submit">Search</button>
                </div>
            </form>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
    
    if( isset($users) ) {

        foreach($users as $user) {
            echo '
                <div class="user-detail">
                    <p>Name: ' .$user["first_name"]. " " .$user["last_name"].'</p>
                    <p>Username: ' .$user["username"]. '</p>
                    <p>Email: ' .$user["email"]. '</p>
                    <p>Country: ' .$user["country"]. '</p>
                    <a href="/admin_updateadminstatus/' .$user["user_id"]. '"><div class="link-whiteButton">
                        View Detail and Update Status
                    </div></a>
                </div>
            ';
        }
    }
?>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>