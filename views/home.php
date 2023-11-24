<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postapol</title>
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/likes.js"></script>
    <script src="/js/menu.js"></script>
    <script src="/js/see_more_btn.js"></script>
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
        <div class="page-content">
            <h1 class="heading-1">Most Recent Posts</h1>
<?php
    require("templates/posts.php");
?>
            <form action="/home/" method="get" class="see-more">
                <input type="hidden" data-last_page="<?= $pages_number ?>">
                <button class="see-more-button" type="submit" name="page_number" value="<?= $next_page ?>">See More Posts</button>
            </form>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>