<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postapol</title>
    <script src="/js/likes.js"></script>
    <script src="/js/home.js"></script>
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
        <h1>Most Recent Posts</h1>
<?php
    require("templates/posts.php");
?>
        <form action="/home/" method="get">
            <input type="hidden" data-last_page="<?= $pages_number ?>">
            <button type="submit" name="page_number" value="<?= $next_page ?>">See More</button>
        </form>
    </main>    
</body>
</html>