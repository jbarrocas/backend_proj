<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Liked Posts</title>
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/likes.js"></script>
    <script src="/js/posts_buttons.js"></script>
    <script src="/js/post_delete.js"></script>
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
        <h1 class="heading-1">Most Liked Posts</h1>
        <h2 class="heading-2">Most Liked Posts of The Month</h2>
<?php
    require("templates/posts.php");
?>
        <h2 class="heading-2">Most Liked Posts of The Week</h2>
<?php
    require("templates/posts_aux.php");
?>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>