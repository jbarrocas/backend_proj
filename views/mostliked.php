<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Liked Posts</title>
    <script src="/js/likes.js"></script>
    <script src="/js/posts_buttons.js"></script>
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
        <h1>Most Liked Posts</h1>
<?php
    require("templates/posts.php");
?>
    </main>    
</body>
</html>